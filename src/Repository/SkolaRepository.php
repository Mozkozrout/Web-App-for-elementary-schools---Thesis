<?php

namespace App\Repository;

use App\Entity\Skola;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Skola|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skola|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skola[]    findAll()
 * @method Skola[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkolaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skola::class);
    }

    // /**
    //  * @return Skola[] Returns an array of Skola objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Skola
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
