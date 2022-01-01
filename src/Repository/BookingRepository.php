<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function findByRange($start,$end)
    {
        if (strstr($start,"1970")) $start = date("Y-m-d");
        if (strstr($end,"1970")) $end = date("Y-m-d");
        $start  = ($start ? $start : date("Y-m-d"));
        $end    = ($end ? $end : date("Y-m-d"));
        $req = $this->createQueryBuilder('b')
        ->andWhere('b.start >= :pstart')
        // ->andWhere('b.end <= :pend')
        ->setParameter('pstart', $start)
        // ->setParameter('pend', $end)
        ->getQuery();
        return $req->getResult()
        ;
    }
    public function findEventsToValidate($start)
    {
        if (strstr($start,"1970")) $start = date("Y-m-d");
        $start  = ($start ? $start : date("Y-m-d"));
        $req = $this->createQueryBuilder('b')
        ->andWhere('b.start >= :pstart')
        ->andWhere('b.isConfirmed != 1')
        ->setParameter('pstart', $start)
        ->orderBy('b.start', 'DESC')
        // ->setParameter('pend', $end)
        ->getQuery();
        return $req->getResult();
    }
    
    public function findMesAteliers($idUser)
    {
        $qb = $this->createQueryBuilder('booking');
        $req = $qb  ->leftJoin ('booking.idUser','t')
                    ->andWhere('t.id = :idUser')
                    ->setParameter('idUser', $idUser)
                    ->orderBy('booking.start', 'DESC')
                    ->getQuery();
        return $req->getResult();
    }

    public function findAllAteliers( $isAdmin='true' )
    {
        // dd($isAdmin);
        $qb = $this->createQueryBuilder('b');
        $qb  ->andWhere('b.jauge > 0');
        if (!$isAdmin) 
            {
                $qb->andWhere("b.isConfirmed = true");
            }
        $qb ->orderBy('b.start', 'DESC');
            $req = $qb->getQuery();
        // dd($req, $isConfirmed);
        return $req->getResult();
    }

    // /**
    //  * @return Booking[] Returns an array of Booking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Booking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
