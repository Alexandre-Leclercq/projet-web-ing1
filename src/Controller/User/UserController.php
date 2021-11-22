<?php

namespace App\Controller\User;

use App\Repository\CategoryRepository;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
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
     * @Route("/course/list/{id?}", name="listCourse", requirements={"id"="\d+"})
     */
    public function list(CourseRepository $courseRepository, ?int $id = null): Response
    {
        //global
        $user = $this->security->getUser();
        $categories = $this->categoryRepository->findBy(['active' => true]);

        if (is_null($id))
            $courses = $courseRepository->findBy(['active' => '1']);
        else
            $courses = $courseRepository->findBy(['active' => '1', 'idCategory' => $id]);

        return $this->render('user/course/list.html.twig', ['user' => $user, 'categories' => $categories, 'courses' => $courses]);
    }
}
