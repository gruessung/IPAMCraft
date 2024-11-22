<?php

namespace App\Repository;

use App\Entity\AssetPropertyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AssetPropertyType>
 *
 * @method AssetPropertyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetPropertyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetPropertyType[]    findAll()
 * @method AssetPropertyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetPropertyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetPropertyType::class);
    }

//    /**
//     * @return AssetPropertyType[] Returns an array of AssetPropertyType objects
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

//    public function findOneBySomeField($value): ?AssetPropertyType
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
