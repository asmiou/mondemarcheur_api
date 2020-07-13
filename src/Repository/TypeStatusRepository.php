<?php

namespace App\Repository;

use App\Entity\TypeStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeStatus[]    findAll()
 * @method TypeStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeStatus::class);
    }

    // /**
    //  * @return TypeStatus[] Returns an array of TypeStatus objects
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
    public function findOneBySomeField($value): ?TypeStatus
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
