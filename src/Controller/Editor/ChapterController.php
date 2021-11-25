<?php

namespace App\Controller\Editor;

use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChapterController extends AbstractController
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
     * @Route("/editor/chapter/list/{idCourse}", name="editor.chapter.list", requirements={"idCourse"="\d+"})
     */
    public function list(Course $course): Response
    {
        //global
        $user = $this->security->getUser();
        $categories = $this->categoryRepository->findBy(['active' => true]);

        return $this->render('editor/chapter/list.html.twig', [
            'user' => $user, 
            'categories' => $categories, 
            'course' => $course
        ]);
    }
}
