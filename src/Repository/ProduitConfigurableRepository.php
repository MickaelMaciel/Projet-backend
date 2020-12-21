<?php

namespace App\Repository;

use App\Entity\ProduitConfigurable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitConfigurable|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitConfigurable|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitConfigurable[]    findAll()
 * @method ProduitConfigurable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitConfigurableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitConfigurable::class);
    }

    // /**
    //  * @return ProduitConfigurable[] Returns an array of ProduitConfigurable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProduitConfigurable
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
