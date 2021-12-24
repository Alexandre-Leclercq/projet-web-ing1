<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use App\Repository\CourseStatusRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
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
     * @var CourseStatusRepository
     */
    private $courseStatusRepository;

    public function __construct(Security $security, CategoryRepository $categoryRepository, ManagerRegistry $managerRegistry, CourseStatusRepository $courseStatusRepository)
    {
        $this->security = $security;
        $this->categoryRepository = $categoryRepository;
        $this->em = $managerRegistry->getManager();
        $this->courseStatusRepository = $courseStatusRepository;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(UserRepository $userRepository): Response
    {
        //global
        $user = $this->security->getUser(); // get current user login
        if(is_null($user)) {
            return $this->render('index.html.twig');
        } else {
            $user = $userRepository->find($user->getIdUser());
            $user->setDateLog((new \DateTime())->setTimezone(new \DateTimeZone($this->getParameter('app.timezone'))));
            $this->em->persist($user);
            $this->em->flush();
            $this->em->clear();

            $lastCourse = $this->courseStatusRepository->findOneBy(['idUser' => $user], ['lastDatetime' => 'DESC']);
            $starredCourses = $this->courseStatusRepository->findBy(['idUser' => $user, 'starred' => true], ['lastDatetime' => 'DESC']);

            return $this->render('user/index.html.twig', [
                'user' => $this->security->getUser(),
                'categories' => $this->categoryRepository->findBy(['active' => true]),
                'lastCourse' => $lastCourse,
                'starredCourses' => $starredCourses
            ]);
        }
    }
}
