<?php

namespace App\Repository;

use App\Entity\Historie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Historie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Historie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Historie[]    findAll()
 * @method Historie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Historie::class);
    }

    // /**
    //  * @return Historie[] Returns an array of Historie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Historie
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
