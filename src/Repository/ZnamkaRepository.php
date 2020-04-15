<?php

namespace App\Repository;

use App\Entity\Znamka;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Znamka|null find($id, $lockMode = null, $lockVersion = null)
 * @method Znamka|null findOneBy(array $criteria, array $orderBy = null)
 * @method Znamka[]    findAll()
 * @method Znamka[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZnamkaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Znamka::class);
    }

    // /**
    //  * @return Znamka[] Returns an array of Znamka objects
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
    public function findOneBySomeField($value): ?Znamka
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
