<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommentType;
use Exception;

/**
 * @Route("/index")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     * @param Request $request
     * @param ArticleRepository $articleRepository
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(Request $request, ArticleRepository $articleRepository): Response
    {
        $page                   = $request->query->get('page') ? : 1 ;
        if ($this->getUser()) {
            $isAdmin            = in_array('ROLE_ADMIN', $this->getUser()->getRoles());
        } else {
            $isAdmin            = false;
        }
        $articles               = $isAdmin     === true ?
            $articleRepository->orderArticleAdmin($page) :
            $articleRepository->orderArticle($page);

        $totalPosts             = $isAdmin     === true ?
            $articleRepository->nbrArticleAdmin():
            $articleRepository->nbrArticle();

        $maxPages               = ceil($totalPosts / 10);

        return $this->render('article/index.html.twig', [
            'articles'          => $articles,
            'maxPages'          => $maxPages,
        ]);
    }

    /**
     *
     * @Route("/{id}", name="article_show")
     * @param Article $article
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function show(Article $article, Request $request): Response
    {
        if ($article->getCensored() === false) {
            $form               = $this->createForm(CommentType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data           = $form->getData();

                if (!$this->getUser() && !$data['username']) {
                    return $this->redirectToRoute('article_index');
                }

                $comment        = new Comment();
                $comment->setContent($data['content']);
                $comment->setPublishDate(new \DateTime('now'));
                $comment->setCensored(false);
                $comment->setUsername($this->getUser() ? $this->getUser()->getUsername() : $data['username']);
                $comment->setArticle($article);

                $entityManager  = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->persist($comment);
                $entityManager->flush();

                try {
                    $entityManager->flush();
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
            }
        }
        return $this->render('article/show.html.twig', [
            'article'       => $article,
            'comments'      => $article->getCensored() === false ? $article->getComments() : '',
            'form'          => isset($form) ? $form->createView() : '' ,
        ]);
    }
}
