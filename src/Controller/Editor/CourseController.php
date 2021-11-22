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
        $user = $this->security;
        $categories = $this->categoryRepository;
        return $this->render('editor/course/list.html.twig', ['user' => $user, 'categories' => $categories]);
    }

    /**
     * @Route("/editor/course/getJson", name="getCourseJson", methods={"GET"})
     */
    public function courseJson(CourseRepository $courseRepository, AjaxResponseJson $ajaxResponseJson): JsonResponse
    {
        $user = $this->security->getUser();
        dd($user->getIdRole());
        if ($user->getIdRole == $this->getParameter('user.idRole.admin'))
            $courses = $courseRepository->getListCourse($user, true);
        else
            $courses = $courseRepository->getListCourse($user, false);
        return new JsonResponse($ajaxResponseJson->listCourseEditor($courses));
    }
}
