<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\Chapter;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }

    public function getListCourse($idUser, bool $admin)
    {
        if ($admin) {
            return $this->createQueryBuilder('c')
                ->select('c as course', 'count(ch.idChapter) qtyChapter')
                ->leftjoin(Chapter::class, 'ch', 'with', 'ch.idCourse = c.idCourse')
                ->orderBy('c.idCourse', 'ASC')
                ->groupBy('c.idCourse')
                ->getQuery()
                ->getResult();
        } else {
            return $this->createQueryBuilder('c')
                ->select('c as course', 'count(ch.idChapter) qtyChapter')
                ->leftjoin(Chapter::class, 'ch', 'with', 'ch.idCourse = c.idCourse')
                ->where('c.idUser = :user')
                ->setParameter('user', $idUser)
                ->orderBy('c.idCourse', 'ASC')
                ->groupBy('c.idCourse')
                ->getQuery()
                ->getResult();
        }
    }
    // /**
    //  * @return Course[] Returns an array of Course objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Course
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
