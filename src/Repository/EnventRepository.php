<?php

namespace App\Repository;

use App\Entity\Envent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Envent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Envent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Envent[]    findAll()
 * @method Envent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Envent::class);
    }

    // /**
    //  * @return Envent[] Returns an array of Envent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Envent
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
