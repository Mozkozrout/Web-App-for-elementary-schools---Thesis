<?php

namespace App\Repository;

use App\Entity\Den;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Den|null find($id, $lockMode = null, $lockVersion = null)
 * @method Den|null findOneBy(array $criteria, array $orderBy = null)
 * @method Den[]    findAll()
 * @method Den[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Den::class);
    }

    // /**
    //  * @return Den[] Returns an array of Den objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Den
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
