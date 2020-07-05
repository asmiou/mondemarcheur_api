<?php

namespace App\Repository;

use App\Entity\TypeRealty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeRealty|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRealty|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRealty[]    findAll()
 * @method TypeRealty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRealtyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRealty::class);
    }

    // /**
    //  * @return TypeRealty[] Returns an array of TypeRealty objects
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
    public function findOneBySomeField($value): ?TypeRealty
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
