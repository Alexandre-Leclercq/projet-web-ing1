<?php

namespace App\Controller\Editor;

use App\Entity\Course;
use App\Entity\Chapter;
use App\Form\Editor\EditChapterType;
use App\Form\Editor\AddChapterType;
use App\Repository\ChapterRepository;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
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

    public function __construct(Security $security, CategoryRepository $categoryRepository, ManagerRegistry $managerRegistry)
    {
        $this->security = $security;
        $this->categoryRepository = $categoryRepository;
        $this->em = $managerRegistry->getManager();
    }

    /**
     * @Route("/editor/chapter/list/{idCourse}", name="editor.chapter.list", requirements={"idCourse"="\d+"})
     */
    public function list(Course $course): Response
    {
        //global
        $user = $this->security->getUser();

        if($user->getIdRole()->getIdRole() != $this->getParameter('user.idRole.admin') && $user != $course->getIdUser()){ // if the user isn't autorize to edit this course
            return $this->redirectToRoute('editor.course.list');
        }

        $categories = $this->categoryRepository->findBy(['active' => true]);

        return $this->render('editor/chapter/list.html.twig', [
            'user' => $user, 
            'categories' => $categories, 
            'course' => $course
        ]);
    }

    /**
     * @Route("/editor/chapter/edit/{id}", name="editor.chapter.edit", requirements={"id"="\d+"})
     */
    public function edit(Chapter $chapter, Request $request)
    {
        $user = $this->security->getUser();

        if($user->getIdRole()->getIdRole() != $this->getParameter('user.idRole.admin') && $user != $chapter->getIdCourse()->getIdUser()){ // if the user isn't autorize to edit this course
            return $this->redirectToRoute('editor.course.list');
        }

        $id = $chapter->getIdCourse()->getIdCourse();
        $form = $this->createForm(EditChapterType::class, $chapter);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->em->clear();
            return $this->redirectToRoute('editor.chapter.list', ['idCourse' => $id]);
        }
        return $this->render('editor/chapter/edit.html.twig', [
            'user' => $user,
            'id' => $id, 
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

        if($user->getIdRole()->getIdRole() != $this->getParameter('user.idRole.admin') && $user != $course->getIdUser()){ // if the user isn't autorize to edit this course
            return $this->redirectToRoute('editor.course.list');
        }

        $chapter = new Chapter();
        $chapter->setIdCourse($course);
        $id = $course->getIdCourse();
        $form = $this->createForm(AddChapterType::class, $chapter);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $maxStep = $chapterRepository->findMaxStep($course->getIdCourse());
            $chapter->setStep($maxStep + 1);
            $this->em->persist($chapter);
            $this->em->flush();
            $this->em->clear();
            return $this->redirectToRoute('editor.chapter.list', ['idCourse' => $id]);
        }
        return $this->render('editor/chapter/add.html.twig', [
            'user' => $user, 
            'id' => $id,
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'form' => $form->createView(),
            'typeForm' => 'Add chapter'
        ]);
    }

    /**
     * @Route("/editor/chapter/duplicate/{id}", name="editor.chapter.duplicate", requirements={"page"="\d+"})
     */
    public function duplicate(Chapter $chapter, Request $request, ChapterRepository $chapterRepository)
    {
        $user = $this->security->getUser();

        if($user->getIdRole()->getIdRole() != $this->getParameter('user.idRole.admin') && $user != $chapter->getIdCourse()->getIdUser()){ // if the user isn't autorize to edit this course
            return $this->redirectToRoute('editor.course.list');
        }

        $id = $chapter->getIdCourse()->getIdCourse();
        $chapterDuplicate = new Chapter();
        $chapterDuplicate->setIdCourse($chapter->getIdCourse())
            ->setCaption($chapter->getCaption())
            ->setContent($chapter->getContent())
            ->setActive($chapter->getActive());
        $form = $this->createForm(AddChapterType::class, $chapterDuplicate);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $maxStep = $chapterRepository->findMaxStep($chapter->getIdCourse());
            $chapterDuplicate->setStep($maxStep + 1);
            $this->em->persist($chapterDuplicate);
            $this->em->flush();
            $this->em->clear();
            return $this->redirectToRoute('editor.chapter.list', ['idCourse' => $id]);
        }
        return $this->render('editor/chapter/add.html.twig', [
            'user' => $user,
            'id' => $id, 
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'form' => $form->createView(),
            'typeForm' => 'Duplicate '.$chapter->getCaption()
        ]);
    }
}
