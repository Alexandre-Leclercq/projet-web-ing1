<?php

namespace App\Controller\User;

use App\Entity\Course;
use App\Entity\CourseStatus;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\ChapterRepository;
use App\Repository\CourseStatusRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var ChapterRepository
     */
    private $chapterRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CourseStatusRepository
     */
    private $courseStatusRepository;

    public function __construct(Security $security, CategoryRepository $categoryRepository, ManagerRegistry $managerRegistry, ChapterRepository $chapterRepository, UserRepository $userRepository, CourseStatusRepository $courseStatusRepository)
    {
        $this->security = $security;
        $this->categoryRepository = $categoryRepository;
        $this->em = $managerRegistry->getManager();
        $this->chapterRepository = $chapterRepository;
        $this->userRepository = $userRepository;
        $this->courseStatusRepository = $courseStatusRepository;
    }

    /**
     * @Route("/course/content/{course}/{step}", name="user.course.content", requirements={"course"="\d+", "step"="\d+"})
     * 
     * @param Course $course
     * @param int $step
     * @param Request $request
     * @return Response
     */
    public function content(Course $course, int $step = 1, Request $request): Response
    {   
        $chaptersList = $this->chapterRepository->findBy(['idCourse' => $course]);
        if(empty($chaptersList)){ // if this course doesn't have chapter
            $this->addFlash('warning', 'Chapter doesn\'t found');
            return $this->redirectToRoute('index');
        }
        $chapter = $this->chapterRepository->findOneBy(['idCourse' => $course, 'step' => $step]);
        if(is_null($chapter)){ // if the step given doesn't exist for that course we choose the first step of the course
            $chapter = $this->chapterRepository->findOneBy(['idCourse' => $course, 'step' => 1]);
        }

        $user = $this->userRepository->find($this->security->getUser()->getIdUser());
        $courseStatus = $this->courseStatusRepository->findOneBy(['idUser' => $user, 'idCourse' => $course]);
        if(is_null($courseStatus)){
            $courseStatus = (new CourseStatus())
                ->setIdUser($user)
                ->setIdCourse($course)
                ->setStarred(false)
                ->setLastDatetime((new \DateTime())->setTimezone(new \DateTimeZone($this->getParameter('app.timezone'))))
                ->setLastChapterReading($chapter);
        } else {
            $courseStatus->setLastDatetime((new \DateTime())->setTimezone(new \DateTimeZone($this->getParameter('app.timezone'))))
                ->setLastChapterReading($chapter);
        }
        $this->em->persist($courseStatus);
        $this->em->flush();

        return $this->render('user/course/content.html.twig', [
            'user' => $user, 
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'chapter' => $chapter,
            'chapters' => $chaptersList
        ]);
    }
}