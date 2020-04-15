<?php

namespace App\Repository;

use App\Entity\Trida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Trida|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trida|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trida[]    findAll()
 * @method Trida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TridaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trida::class);
    }

    // /**
    //  * @return Trida[] Returns an array of Trida objects
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
    public function findOneBySomeField($value): ?Trida
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
