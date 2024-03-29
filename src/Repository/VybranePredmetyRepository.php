<?php

namespace App\Repository;

use App\Entity\VybranePredmety;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VybranePredmety|null find($id, $lockMode = null, $lockVersion = null)
 * @method VybranePredmety|null findOneBy(array $criteria, array $orderBy = null)
 * @method VybranePredmety[]    findAll()
 * @method VybranePredmety[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VybranePredmetyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VybranePredmety::class);
    }

    // /**
    //  * @return VybranePredmety[] Returns an array of VybranePredmety objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VybranePredmety
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
