<?php

namespace App\Controller\Editor;

use App\Repository\CategoryRepository;
use App\Repository\CourseRepository;
use App\Service\AjaxResponseJson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/editor/course/list", name="editorListCourse")
     */
    public function list(CourseRepository $courseRepository): Response
    {
        //global
        $user = $this->security->getUser();
        $categories = $this->categoryRepository->findBy(['active' => true]);

        return $this->render('editor/course/list.html.twig', ['user' => $user, 'categories' => $categories]);
    }
}
