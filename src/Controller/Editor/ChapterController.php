<?php

namespace App\Controller\Editor;

use App\Entity\Course;
use App\Services\FileUploader;
use App\Repository\CourseRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/editor/chapter/add", name="editor.chapter.add")
     */
    public function add(Request $request, FileUploader $fileUploader)
    {

    }

    /**
     * @Route("/editor/chapter/duplicate", name="editor.chapter.duplicate")
     */
    public function duplicate(Request $request, FileUploader $fileUploader)
    {

    }
}
