<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

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

    public function __construct(Security $security, CategoryRepository $categoryRepository)
    {
        $this->security = $security;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/course/list/{id}", name="listCourse",  requirements={"id"="\d+"})
     */
    public function list(CourseRepository $courseRepository): Response
    {
        $courses = $courseRepository->findBy(['active' => '1']);
        $user = $this->security->getUser();
        $categories = $this->categoryRepository->findBy(['active' => true]);
        //dd($courses);
        return $this->render('user/course/index.html.twig', ['user' => $user, 'categories' => $categories, 'courses' => $courses]);
    }

    /**
     * @Route("/course/edit", name="editCourse")
     */
    public function edit(): Response
    {
        return $this->render('editor/course/index.html.twig');
    }

    /**
     * @Route("/course/add", name="addCourse")
     */
    public function add(): Response
    {
        return $this->render('editor/course/index.html.twig');
    }
}
