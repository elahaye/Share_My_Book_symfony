<?php

namespace App\Repository;

use App\Entity\Booklist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Booklist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booklist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booklist[]    findAll()
 * @method Booklist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooklistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booklist::class);
    }

    // /**
    //  * @return Booklist[] Returns an array of Booklist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Booklist
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
