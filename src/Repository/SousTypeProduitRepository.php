<?php

namespace App\Repository;

use App\Entity\SousTypeProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SousTypeProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousTypeProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousTypeProduit[]    findAll()
 * @method SousTypeProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousTypeProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousTypeProduit::class);
    }

    // /**
    //  * @return SousTypeProduit[] Returns an array of SousTypeProduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SousTypeProduit
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
