<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\IdeaProposition;
use App\Form\SearchDataType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;

/**
 * @method IdeaProposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdeaProposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdeaProposition[]    findAll()
 * @method IdeaProposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaPropositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, IdeaProposition::class);
        $this->paginator = $paginator;
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

    /**
     * @return PaginationInterface
     */
    }
    public function findSearch(SearchData $search): PaginationInterface
    {
        $query = $this
        ->createQueryBuilder('i')
        ->select('i');
    if  (!empty($search->q)) {
        $query = $query
            ->andWhere('i.title LIKE :q')
            ->setParameter('q', "%{$search->q}%");
    }
    if  (!empty($search->min)) {
        $query = $query
            ->andWhere('i.totalScore >= :min')
            ->setParameter('min', "%{$search->min}%");
    }
    if  (!empty($search->max)) {
        $query = $query
            ->andWhere('i.totalScore <= :max')
            ->setParameter('max', "%{$search->max}%");
    }
    if  (($search->tri)==1) {

        $query = $query
            
            ->orderBy('i.date', 'DESC');
            
    }
        $query = $this->getSearchQuery($search)->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            27
        );
    }
    private function getSearchQuery(SearchData $search): ORMQueryBuilder
    {
        $query = $this
        ->createQueryBuilder('i')
        ->select('i');
    if  (!empty($search->q)) {
        $query = $query
            ->andWhere('i.title LIKE :q')
            ->setParameter('q', "%{$search->q}%");
    }
    if  (!empty($search->min)) {
        $query = $query
            ->andWhere('i.totalScore >= :min')
            ->setParameter('min', "%{$search->min}%");
    }
    if  (!empty($search->max)) {
        $query = $query
            ->andWhere('i.totalScore <= :max')
            ->setParameter('max', "%{$search->max}%");
    }
    if  (($search->tri)==1) {

        $query = $query
            
            ->orderBy('i.date', 'DESC');
            
    }
        return $query;
    }
    /**
     * Récupère le score minimum et maximum correspondant a une recherche
     * @return integer[]
     */
    public function findMinMax(SearchData $search): array
    {
        $results = $this->getSearchQuery($search, true)
            ->select('MIN(i.totalScore) as min', 'MAX(i.totalScore) as max')
            ->getQuery()
            ->getScalarResult();
        return [(int)$results[0]['min'], (int)$results[0]['max']];
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
