<?php

namespace App\Repository;

use App\Entity\CategoryRealty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryRealty|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryRealty|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryRealty[]    findAll()
 * @method CategoryRealty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRealtyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryRealty::class);
    }

    // /**
    //  * @return CategoryRealty[] Returns an array of CategoryRealty objects
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
    public function findOneBySomeField($value): ?CategoryRealty
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
