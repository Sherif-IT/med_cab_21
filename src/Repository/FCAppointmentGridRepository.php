<?php

namespace App\Repository;

use App\Entity\FCAppointmentGrid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FCAppointmentGrid|null find($id, $lockMode = null, $lockVersion = null)
 * @method FCAppointmentGrid|null findOneBy(array $criteria, array $orderBy = null)
 * @method FCAppointmentGrid[]    findAll()
 * @method FCAppointmentGrid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FCAppointmentGridRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FCAppointmentGrid::class);
    }

    // /**
    //  * @return FCAppointmentGrid[] Returns an array of FCAppointmentGrid objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FCAppointmentGrid
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
