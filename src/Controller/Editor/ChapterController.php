<?php

namespace App\Controller\Editor;

use App\Entity\Course;
use App\Entity\Chapter;
use App\Repository\ChapterRepository;
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
     * @Route("/editor/chapter/edit/{id}", name="editor.chapter.edit", requirements={"page"="\d+"})
     */
    public function edit(Chapter $chapter, Request $request)
    {
        $user = $this->security->getUser();

        $form = $this->createForm(ChapterType::class, $chapter);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->em->clear();
            return $this->redirectToRoute('editor.chapter.list');
        }
        return $this->render('editor/course/edit.html.twig', [
            'user' => $user, 
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'form' => $form->createView(),
            'typeForm' => 'Edit '.$chapter->getCaption()
        ]);
    }

    /**
     * @Route("/editor/chapter/add/{id}", name="editor.chapter.add", requirements={"page"="\d+"})
     */
    public function add(Course $course, Request $request, ChapterRepository $chapterRepository)
    {
        $user = $this->security->getUser();
        $chapter = new Chapter();
        $chapter->setIdCourse($course);

        $form = $this->createForm(ChapterType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $maxStep = $chapterRepository->findMaxStep($course->getIdCourse());
            $chapter->setStep($maxStep + 1);
            $this->em->persist($chapter);
            $this->em->flush();
            $this->em->clear();
            return $this->redirectToRoute('editor.chapter.list');
        }
        return $this->render('editor/chapter/edit.html.twig', [
            'user' => $user, 
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'form' => $form->createView(),
            'typeForm' => 'Add chapter'
        ]);
    }

    /**
     * @Route("/editor/chapter/duplicate/{id}", name="editor.chapter.duplicate", requirements={"page"="\d+"})
     */
    public function duplicate(Request $request)
    {

    }
}
