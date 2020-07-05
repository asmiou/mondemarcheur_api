<?php

namespace App\Repository;

use App\Entity\TypeAiring;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeAiring|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAiring|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAiring[]    findAll()
 * @method TypeAiring[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAiringRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeAiring::class);
    }

    // /**
    //  * @return TypeAiring[] Returns an array of TypeAiring objects
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
    public function findOneBySomeField($value): ?TypeAiring
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
