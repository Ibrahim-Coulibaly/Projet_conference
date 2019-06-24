<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param int $currentPage
     * @return mixed
     * @throws \Exception
     */
    public function orderArticle(int $currentPage = 1)
    {
         return $this->createQueryBuilder('a')
            ->orderBy('a.publish_date', 'DESC')
            ->andWhere('a.publish_date <= :val')
            ->setParameter('val', new \DateTime('now'))
            ->getQuery()
            ->setMaxResults(10)
            ->setFirstResult(($currentPage-1) * 10)
            ->getResult()
            ;
    }

    public function orderArticleAdmin(int $currentPage = 1)
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.publish_date', 'DESC')
            ->getQuery()
            ->setMaxResults(10)
            ->setFirstResult(($currentPage-1) * 10)
            ->getResult()
            ;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function nbrArticle()
    {
        return $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->andWhere('a.publish_date <= :val')
            ->setParameter('val', new \DateTime('now'))
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function nbrArticleAdmin()
    {
        return $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
