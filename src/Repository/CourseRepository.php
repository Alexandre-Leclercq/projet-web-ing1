<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\Chapter;
use App\Entity\CourseStatus;
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

    /**
     * give the list of course that could be filter by category
     */
    public function getUserListCourse($idUser, $idCategory = null)
    {
        if(is_null($idCategory)){
            return $this->createQueryBuilder('c')
                ->select('c as course')
                ->addSelect('cs.starred as starred')
                ->addSelect('cs.lastDatetime as lastDatetime')
                ->addSelect('ch.step as step')
                ->leftJoin(CourseStatus::class, 'cs', 'with', 'cs.idCourse = c.idCourse and cs.idUser = :user')
                ->leftJoin(Chapter::class, 'ch', 'with', 'ch.idChapter = cs.lastChapterReading')
                ->andWhere('c.active = 1')
                ->setParameter('user', $idUser)
                ->orderBy('c.caption', 'ASC')
                ->getQuery()
                ->getResult();
        } else {
            return $this->createQueryBuilder('c')
                ->select('c as course')
                ->addSelect('cs.starred as starred')
                ->addSelect('cs.lastDatetime as lastDatetime')
                ->addSelect('ch.step as step')
                ->leftJoin(CourseStatus::class, 'cs', 'with', 'cs.idCourse = c.idCourse and cs.idUser = :user')
                ->leftJoin(Chapter::class, 'ch', 'with', 'ch.idChapter = cs.lastChapterReading')
                ->andWhere('c.idCategory = :category')
                ->andWhere('c.active = 1')
                ->setParameter('user', $idUser)
                ->setParameter('category', $idCategory)
                ->orderBy('c.caption', 'ASC')
                ->getQuery()
                ->getResult();
        }
    }

    /**
     * get the list of course that an editor possessed
     */
    public function getListEditorCourse($idUser, bool $admin)
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
}
