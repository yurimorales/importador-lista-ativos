<?php

namespace App\Repository;

use App\Entity\TipoUso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoUso|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoUso|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoUso[]    findAll()
 * @method TipoUso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoUsoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoUso::class);
    }

    // /**
    //  * @return TipoUso[] Returns an array of TipoUso objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoUso
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
