<?php

namespace App\Repository;

use App\Entity\Chapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chapter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chapter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chapter[]    findAll()
 * @method Chapter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChapterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chapter::class);
    }

    /**
     * get the chapter list of a course
     */
    public function getListChapter($idCourse)
    {
        return $this->createQueryBuilder('c')
            ->where('c.idCourse = :idCourse')
            ->setParameter('idCourse', $idCourse)
            ->getQuery()
            ->getResult();
    }

    /**
     * give the max step of a course
     */
    public function findMaxStep($idCourse)
    {
        return $this->createQueryBuilder('c')
            ->select('MAX(c.step)')
            ->andWhere('c.idCourse = :id')
            ->setParameter('id', $idCourse)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
