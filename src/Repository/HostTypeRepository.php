<?php

namespace App\Repository;

use App\Entity\HostType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HostType>
 *
 * @method HostType|null find($id, $lockMode = null, $lockVersion = null)
 * @method HostType|null findOneBy(array $criteria, array $orderBy = null)
 * @method HostType[]    findAll()
 * @method HostType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HostTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HostType::class);
    }

//    /**
//     * @return HostType[] Returns an array of HostType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HostType
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
