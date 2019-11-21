<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\BookSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findByAuthors($id){
        $query = $this->createQueryBuilder('b');
        $query->join('b.authors', 'author')
            ->where($query->expr()->eq('author.id', $id));
        return $query->getQuery()->getResult();
    }

    public function findByTheme($id){
        $query = $this->createQueryBuilder('b');
        $query->join('b.theme', 'theme')
            ->where($query->expr()->eq('theme.id', $id));
        return $query->getQuery()->getResult();
    }


    public function findByEditor($id){
        $query = $this->createQueryBuilder('b')
            ->orderBy('b.title', 'ASC')
            ->andWhere('b.editor = :id')
            ->setParameter('id', $id);

        return $query->getQuery()->getResult();
    }
    public function findByTitleAvailability(BookSearch $search) : Query
    {
        $query = $this->createQueryBuilder('b')
            ->orderBy('b.title', 'ASC');
        if($search->getTitle()){
            $query = $query
                ->andWhere('b.title LIKE :title')
                ->setParameter('title' , "%".$search->getTitle()."%");
        }
        if($search->getAvailability()){
            $query = $query
                ->andWhere('b.Availability = :availability')
                ->setParameter('availability', $search->getAvailability());
        }
        if($search->getLanguage()){
            $query = $query
                ->andWhere('b.language = :language')
                ->setParameter('language', $search->getLanguage());
        }
        return $query->getQuery();
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
