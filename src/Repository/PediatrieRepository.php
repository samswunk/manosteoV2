<?php

namespace App\Repository;

use App\Entity\Pediatrie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pediatrie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pediatrie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pediatrie[]    findAll()
 * @method Pediatrie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PediatrieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pediatrie::class);
    }

    // /**
    //  * @return Pediatrie[] Returns an array of Pediatrie objects
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
    public function findOneBySomeField($value): ?Pediatrie
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
