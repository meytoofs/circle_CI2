<?php

namespace App\Repository;

use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    /**
     * @return string
     */
    public function allMessages(): string
    {
        $query = $this
        ->createQueryBuilder('room')
        ->select('room', 'm')
        ->join('room.messages', 'm')
        ->where('m.room = 1')
        ->getQuery()
        ->getResult()
        ;
        return $query;
    }
    // /**
    //  * Récupère tout les messages en lien avec une room
    //  * @return array[]
    //  */
    // public function messages(): ORMQueryBuilder
    // {
    //     $query = $this
    //     ->createQueryBuilder('mess')
    //     ->select('message')
    //     ->where('r_id = 1');
    // }
    // /**
    //  * @return Room[] Returns an array of Room objects
    //  */
    /*
    public function findBy($value)
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

    /*
    public function findOneBySomeField($value): ?Room
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
