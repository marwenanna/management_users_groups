<?php

namespace App\Repository;

use App\Entity\Busr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Busr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Busr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Busr[]    findAll()
 * @method Busr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusrRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Busr::class);
    }

    /**
      * @return Query
     */

    public function findAllVisible():Query
    {

    }


    /*
    public function findOneBySomeField($value): ?Busr
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
