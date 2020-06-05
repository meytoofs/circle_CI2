<?php

namespace App\Repository;

use App\Entity\IdeaProposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IdeaProposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdeaProposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdeaProposition[]    findAll()
 * @method IdeaProposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaPropositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdeaProposition::class);
    }
    public function getAllSVG()
    {
        $result = $this
        ->createQueryBuilder('i')
        ->select('i')
        ->join('i.noteHistories', 'n')
        ->where('n.ideaProposition = i.id')
        ->getQuery()
        ->getResult();
        return $result;
    }
    // /**
    //  * @return IdeaProposition[] Returns an array of IdeaProposition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IdeaProposition
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
