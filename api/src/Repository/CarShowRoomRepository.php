<?php

namespace App\Repository;

use App\Entity\CarShowRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarShowRoom|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarShowRoom|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarShowRoom[]    findAll()
 * @method CarShowRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarShowRoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarShowRoom::class);
    }

    // /**
    //  * @return CarShowRoom[] Returns an array of CarShowRoom objects
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
    public function findOneBySomeField($value): ?CarShowRoom
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
