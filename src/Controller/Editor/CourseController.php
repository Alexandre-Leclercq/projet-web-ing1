<?php

namespace App\Controller\Editor;

use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Repository\CategoryRepository;
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

    public function __construct(Security $security, CategoryRepository $categoryRepository)
    {
        $this->security = $security;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/editor/course/list", name="editor.course.list")
     */
    public function list(CourseRepository $courseRepository): Response
    {
        //global
        $user = $this->security->getUser();
        $categories = $this->categoryRepository->findBy(['active' => true]);

        return $this->render('editor/course/list.html.twig', [
            'user' => $user, 
            'categories' => $categories
        ]);
    }
}
