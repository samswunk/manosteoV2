<?php

namespace App\Repository;

use App\Entity\Accouchement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Accouchement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accouchement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accouchement[]    findAll()
 * @method Accouchement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccouchementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accouchement::class);
    }

    // /**
    //  * @return Accouchement[] Returns an array of Accouchement objects
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
    public function findOneBySomeField($value): ?Accouchement
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
