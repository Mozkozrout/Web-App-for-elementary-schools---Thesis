<?php

namespace App\Repository;

use App\Entity\Cas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cas[]    findAll()
 * @method Cas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cas::class);
    }

    // /**
    //  * @return Cas[] Returns an array of Cas objects
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
    public function findOneBySomeField($value): ?Cas
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
