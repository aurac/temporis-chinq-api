<?php

namespace App\Repository;

use App\Entity\RecipeLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipeLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeLevel[]    findAll()
 * @method RecipeLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeLevel::class);
    }

    // /**
    //  * @return RecipeLevel[] Returns an array of RecipeLevel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecipeLevel
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
