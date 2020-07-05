<?php

namespace App\Repository;

use App\Entity\TypeFurniture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeFurniture|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeFurniture|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeFurniture[]    findAll()
 * @method TypeFurniture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeFurnitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeFurniture::class);
    }

    // /**
    //  * @return TypeFurniture[] Returns an array of TypeFurniture objects
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
    public function findOneBySomeField($value): ?TypeFurniture
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
