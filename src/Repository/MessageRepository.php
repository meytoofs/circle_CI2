<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\ChoiceList\ORMQueryBuilderLoader;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }
    public function allMessages(): ORMQueryBuilder 
    {
        $query = $this
        ->createQueryBuilder('room')
        ->select('r', 'm')
        ->join('room.messages', 'm')
        ->where('m.room_id = 1')
        ->getQuery()->getResult()
        ;
        return $query;
    }
    // /**
    //  * @return Message[] Returns an array of Message objects
    //  */
    /*
    public function findBy()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('r.id = 1')
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Message
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
