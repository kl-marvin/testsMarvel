<?php

namespace App\Repository;

use App\Entity\Caracter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Caracter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caracter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caracter[]    findAll()
 * @method Caracter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Caracter::class);
    }

    // /**
    //  * @return Caracter[] Returns an array of Caracter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Caracter
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
