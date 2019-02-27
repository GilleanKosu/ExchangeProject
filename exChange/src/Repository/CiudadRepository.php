<?php

namespace App\Repository;

use App\Entity\Ciudad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ciudad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ciudad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ciudad[]    findAll()
 * @method Ciudad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiudadRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ciudad::class);
    }

    // /**
    //  * @return Ciudad[] Returns an array of Ciudad objects
    //  */
    
    public function findByName($value){
        return $this->createQueryBuilder('c')
            ->andWhere('c.nombreC = :val')
            ->setParameter('val', $value)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByName($value): ?Ciudad
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nombreC = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findOneIdByName($value): ?Ciudad
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nombreC = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Ciudad
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
