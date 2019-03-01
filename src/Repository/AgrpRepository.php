<?php

namespace App\Repository;

use App\Entity\Agrp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Agrp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agrp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agrp[]    findAll()
 * @method Agrp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgrpRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Agrp::class);
    }

    // /**
    //  * @return Agrp[] Returns an array of Agrp objects
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
    public function findOneBySomeField($value): ?Agrp
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
