<?php

namespace App\Repository;

use App\Entity\Traumato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Traumato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traumato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traumato[]    findAll()
 * @method Traumato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraumatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Traumato::class);
    }

    // /**
    //  * @return Traumato[] Returns an array of Traumato objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Traumato
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
