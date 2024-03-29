<?php

namespace App\Repository;

use App\Entity\Ucebna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ucebna|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ucebna|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ucebna[]    findAll()
 * @method Ucebna[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UcebnaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ucebna::class);
    }

    // /**
    //  * @return Ucebna[] Returns an array of Ucebna objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ucebna
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
