<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Game;
use App\Entity\Article;

use App\Form\PlayType;

use App\Repository\GameRepository;
use App\Repository\UserRepository;

use App\Manager\UserManager;
use App\Manager\GameManager;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function index() : Response
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    /**
     * @Route("/game/play", name="game_play")
     * @param GameRepository $gameRepository
     * @param UserRepository $userRepository
     * @param Request $request
     * @return Response
     */
    public function play(GameRepository $gameRepository, UserRepository $userRepository, Request $request) : Response
    {
        /** @var Game $lastGame */
        $lastGame           = $gameRepository->findLast();
        if ($lastGame == false) {
            $this->addFlash('error', 'Il n\'y a pas de jeux');
            return $this->redirectToRoute('game_play');
        }
        if ($this->getUser()->getAmount() < 1) {
            $this->addFlash('error', 'Il semble que vous n\'êtes pa connecté');
            return $this->redirectToRoute('article_index');
        }
        /** @var array $cases */
        $cases              = $lastGame->getCases();
        if (!$cases) {
            $this->addFlash('error', 'No bet found');
            return $this->redirectToRoute('game_play');
        }
        /** @var array $aCases */
        $aCases             = [];
        foreach ($cases as $row) {
            $aCases[ $row->getNumber() ] = $row->getColor();
        }
        $form               = $this->createForm(PlayType::class, ['round'         => $lastGame->getId(),
            'mise'          => ($this->getUser()->getAmount() * (0.10)),
            'numero'        => $aCases,
            ], [
                'user' => $this->getUser(),
            ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var array $data */
            $data           = $form->getData();

            if (!$this->getUser()) {
                $this->addFlash('error', 'Il semble que vous n\'êtes pa connecté');
                return $this->redirectToRoute('game_play');
            }
            //-------------------------Déduction de mise + induction dans bank----------------------------------------
            $newAmount      = ($this->getUser()->getAmount()) - ($data['mise']);
            $this->getUser()->setAmount($newAmount);
            $lastGame->setAmount($lastGame->getAmount() + $data['mise']);
            //--------------------------Prépare la mise pour la prochaine partie--------------------------------------
            $userManager    = new UserManager();
            $numero         = $userManager->getMise($this->getUser()->getNextBet()).$data['case'];
            $mise           = $userManager->getNumber($this->getUser()->getNextBet()).$data['mise'];

            $this->getUser()->setNextBet($numero.'-'.$mise);

            //--------------------------Game---------------------------------------
            $lastGame->addUser($this->getUser());
            //--------------------------Doctrine---------------------------------------
            $entityManager  = $this->getDoctrine()->getManager();
            $entityManager->persist($this->getUser());
            $entityManager->persist($lastGame);
            try {
                $entityManager->flush();
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }
            $msg = 'Vous avez misé '.$data['mise'].'$ sur la case '.$data['case'].
                ' pour la prochaine partie. Le montant de table s\'élevra à '.
                ($userManager->tableGain($userRepository)).
                '$. Vous jouer pour un gain potentiel de '.($data['mise'] * 35);

            $this->addFlash('success', $msg);
            return $this->render('game/play.html.twig', [
                'form'      => $form->createView(),
                'cases'     => $cases,
            ]);
        }

        return $this->render('game/play.html.twig', [
            'form'          => $form->createView(),
            'cases'         => $cases,
        ]);
    }

    /**
     * @Route("/game/run", name="game_run")
     * @param UserRepository $userRepository
     * @param GameRepository $gameRepository
     * @return Response
     * @throws \Exception
     */
    public function run(UserRepository $userRepository, GameRepository $gameRepository) : Response
    {
        $game               = new Game();
        $userManager        = new UserManager();
        $gameManager        = new GameManager();
        /** @var array $cases */
        $cases              = $game->getCases();
        /** @var array $aPlayer */
        $aPlayer            = $userRepository->nextPlayers() ? : null;

        //----------------Lance la roue-------------------
        /** @var int $rand */
        $rand               = array_rand($cases, 1);
        $finalResult        = $cases[$rand];
        //------------------------------------------------

        $result = [];
        if ($aPlayer) {
            foreach ($aPlayer as $player) {
                $numCase    = $userManager->getMise($player->getNextBet());
                $betAmount  = $userManager->getNumber($player->getNextBet());
                /** @var array $numCase */
                $numCase    = array_filter(explode(',', $numCase));
                /** @var array $betAmount */
                $betAmount  = array_filter(explode(',', $betAmount));
                if (!$numCase || !$betAmount) {
                    $this->addFlash('error', 'No bet found');
                    return $this->redirectToRoute('game_play');
                }
                foreach ($numCase as $key => $case) {
                    if ($case == $finalResult->getNumber()) {
                        /*
                        if ($cases[$case]->getColor() == $finalResult->getColor()){

                        }*/
                        $result[] = $player->getUsername(). ' a joué'.(int)$betAmount[$key].
                            '$ sur le '.$case.' et  a Gagné '.
                            ((int)$betAmount[$key] * 35).'$';
                            $gameManager->payed($player, (int)$betAmount[$key] * 35);
                    } else {
                        $result[] = ucfirst($player->getUsername()) .
                            ' a joué sur le '.$case.' et  a Perdu ';
                    }
                }
                $player->setNextBet('');
            }
            $result         = array_merge(['tirage' => 'Tirage -> '.$finalResult->getNumber().
                '('.$finalResult->getColor().')'], ['bets' => $result]);

            //----------------------------Cree un article------------------------------------
            $content        = '';
            /** @var array $Bets */
            $Bets           = (array)$result['bets'];
            foreach ($Bets as $row) {
                $content .= $row.' | ';
            }
            $lastGame       = $gameRepository->findLast();
            $article        = new Article();
            $article->setContent($content);
            $article->setTitle('Résultat du jeux n° '.$lastGame->getId());
            $article->setPublishDate(new \DateTime('now + 4hour'));
            $article->setImage('/game1.jpg');
            $article->setCensored(false);
            $entityManager  = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            //-------------------------------Cree un nouveau jeu---------------------------------
            $newGame        = new Game();
            $newGame->setAmount($lastGame->getAmount());
            $newGame->setStarted($date = new \DateTime('now +2 hour'));
            $entityManager->persist($newGame);
            $entityManager->flush();
            //----------------------------------------------------------------
        }

        return $this->render('game/run.html.twig', ['result' => $result]);
    }

    /**
     * @Route("/account", name="account_show")
     * @param GameRepository $gameRepository
     * @return Response
     */
    public function userGame(GameRepository $gameRepository): Response
    {
        $game = $gameRepository->findAll();

        return $this->render('account/index.html.twig', [
            'games'      => $game,
        ]);
    }
}
