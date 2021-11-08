<?php

namespace App\Repository;

use App\Entity\Confrere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Confrere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Confrere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Confrere[]    findAll()
 * @method Confrere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfrereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Confrere::class);
    }

    // /**
    //  * @return Confrere[] Returns an array of Confrere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Confrere
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
