<?php

namespace App\Repository;

use App\Entity\CourseStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CourseStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseStatus[]    findAll()
 * @method CourseStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourseStatus::class);
    }
    
    // get the last course a user visit
    public function lastCourse($user): ?CourseStatus
    {
        return $this->createQueryBuilder('cs')
            ->andWhere('cs.idUser = :user')
            ->andWhere('cs.lastDatetime IS NOT NULL')
            ->orderBy('cs.lastDatetime', 'DESC')
            ->setParameter('user', $user)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
