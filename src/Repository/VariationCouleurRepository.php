<?php

namespace App\Repository;

use App\Entity\VariationCouleur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VariationCouleur|null find($id, $lockMode = null, $lockVersion = null)
 * @method VariationCouleur|null findOneBy(array $criteria, array $orderBy = null)
 * @method VariationCouleur[]    findAll()
 * @method VariationCouleur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariationCouleurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VariationCouleur::class);
    }

    // /**
    //  * @return VariationCouleur[] Returns an array of VariationCouleur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VariationCouleur
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
