<?php

namespace App\Repository;

use App\Entity\EnvoyePar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnvoyePar|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnvoyePar|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnvoyePar[]    findAll()
 * @method EnvoyePar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnvoyeParRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnvoyePar::class);
    }

    // /**
    //  * @return EnvoyePar[] Returns an array of EnvoyePar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnvoyePar
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
