<?php

namespace App\Repository;

use App\Entity\Ativos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ativos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ativos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ativos[]    findAll()
 * @method Ativos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtivosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ativos::class);
    }

    // /**
    //  * @return Ativos[] Returns an array of Ativos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ativos
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
