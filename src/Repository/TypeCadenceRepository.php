<?php

namespace App\Repository;

use App\Entity\TypeCadence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeCadence|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCadence|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCadence[]    findAll()
 * @method TypeCadence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCadenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeCadence::class);
    }

    // /**
    //  * @return TypeCadence[] Returns an array of TypeCadence objects
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
    public function findOneBySomeField($value): ?TypeCadence
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
