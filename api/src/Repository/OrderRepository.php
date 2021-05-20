<?php

namespace App\Repository;

use App\Entity\Car;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findByClientId($id) {

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('o.id, o.create_dt, o.client_id, o.manager_id, o.car_id, o.car_showroom_id,
                          c.car_showroom_id as car_room, c.model, c.brand, c.price')
            ->from($this->getEntityName(), 'o')
            ->innerJoin(Car::class, 'c', 'WITH', 'o.car_id = c.id')
            ->where("o.client_id = $id")
            ->orderBy('o.id', 'ASC');

            // ->andWhere('o.client_id = :client_id')
            // ->setParameter('client_id', $id)

        return $qb->getQuery()->getResult();
    }


    // /**
    //  * @return Order[] Returns an array of Order objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

//    public function getQueryPrepare($sql, $field, $value) {
//        $conn = $this->getEntityManager()->getConnection();
//        $stmt = $conn->prepare($sql);
//        $stmt->execute($data);
//        return $stmt->fetchAll();
//    }
}
