<?php

namespace App\Repository;

use App\Entity\ArticleSimple;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleSimple|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleSimple|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleSimple[]    findAll()
 * @method ArticleSimple[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleSimpleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleSimple::class);
    }

    // /**
    //  * @return ArticleSimple[] Returns an array of ArticleSimple objects
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
    public function findOneBySomeField($value): ?ArticleSimple
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
