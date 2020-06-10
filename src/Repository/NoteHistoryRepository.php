<?php

namespace App\Repository;

use App\Entity\NoteHistory;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method NoteHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteHistory[]    findAll()
 * @method NoteHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteHistory::class);
    }
    
    public function getAVG($id)
    {
        $result = $this
        ->createQueryBuilder('n')
        ->select("avg(n.score)")
        ->where('n.ideaProposition = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getSingleResult();
        if ($result){
            return $result[1];
        }
        return 0;
    }
    // /**
    //  * @return NoteHistory[] Returns an array of NoteHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NoteHistory
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
