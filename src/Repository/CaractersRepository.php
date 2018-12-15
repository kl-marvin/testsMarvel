<?php

namespace App\Repository;

use App\Entity\Caracters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Caracters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caracters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caracters[]    findAll()
 * @method Caracters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaractersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Caracters::class);
    }

    // /**
    //  * @return Caracters[] Returns an array of Caracters objects
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
    public function findOneBySomeField($value): ?Caracters
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
