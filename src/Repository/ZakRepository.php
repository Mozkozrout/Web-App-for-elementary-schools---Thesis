<?php

namespace App\Repository;

use App\Entity\Zak;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Zak|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zak|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zak[]    findAll()
 * @method Zak[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZakRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zak::class);
    }

    // /**
    //  * @return Zak[] Returns an array of Zak objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zak
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
