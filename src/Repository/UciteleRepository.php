<?php

namespace App\Repository;

use App\Entity\Ucitele;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ucitele|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ucitele|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ucitele[]    findAll()
 * @method Ucitele[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UciteleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ucitele::class);
    }

    public function findUcitelWithTrida(int $id)
    {
        $qb = $this -> createQueryBuilder('u');

        $qb -> select('u.Jmeno')
            -> addSelect('u.id AS ucitel_id')
            -> addSelect('t.nazev')
            -> addSelect('t.id AS trida_id')
            -> innerJoin('u.trida', 't')
            -> where('u.id = :id')
            -> setParameter('id', $id)
        ;

        return $qb -> getQuery() -> getResult();
    }

    // /**
    //  * @return Ucitele[] Returns an array of Ucitele objects
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
    public function findOneBySomeField($value): ?Ucitele
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
