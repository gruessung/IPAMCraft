<?php

namespace App\Repository;

use App\Entity\AssetProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AssetProperty>
 *
 * @method AssetProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetProperty[]    findAll()
 * @method AssetProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetProperty::class);
    }

//    /**
//     * @return AssetProperty[] Returns an array of AssetProperty objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AssetProperty
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
