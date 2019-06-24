<?php

namespace App\Manager;

use App\Entity\User;
use App\Entity\Article;
use Doctrine\ORM\EntityManager;

class GameManager
{
    /* @var Doctrine\ORM\EntityManager $em */
    protected $em;

    /**
     * OneLevel Constructor
     *
     * @param EntityManager $em
     */
    public function make(EntityManager $em)
    {
        return $em;
    }
    /**
     * @param User $user
     * @param int|null $gain
     */
    public function payed(User $user, int $gain = null) :void
    {
        $initAmount     =  (int)$user->getAmount();
        $user->setAmount(($gain + $initAmount));
    }
}
