<?php

namespace App\Repository;

use App\Entity\Doba;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Doba|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doba|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doba[]    findAll()
 * @method Doba[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DobaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doba::class);
    }

    // /**
    //  * @return Doba[] Returns an array of Doba objects
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
    public function findOneBySomeField($value): ?Doba
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
