<?php

namespace App\Controller\Editor;

use App\Entity\Course;
use App\Form\CourseType;
use App\Services\FileUploader;
use App\Repository\CourseRepository;
use App\Repository\ChapterRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
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
    public function list(): Response
    {
        //global
        $user = $this->security->getUser();
        $categories = $this->categoryRepository->findBy(['active' => true]);

        return $this->render('editor/course/list.html.twig', [
            'user' => $user, 
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/editor/course/edit/{id}", name="editor.course.edit", requirements={"id"="\d+"})
     */
    public function edit(Course $course, Request $request, FileUploader $fileUploader)
    {
        $user = $this->security->getUser();

        $form = $this->createForm(CourseType::class, $course, [
            'admin' => $user->getIdRole()->getIdRole() == $this->getParameter('user.idRole.admin') ? true : false
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if(!is_null($form->get('image')->getData())){
                $filename = $fileUploader->uploadFile($form->get('image')->getData());
                $course->setFilelink($filename);
            }
            $this->em->persist($course);
            $this->em->flush();
            $this->em->clear();
            return $this->redirectToRoute('editor.course.list');
        }
        return $this->render('editor/course/edit.html.twig', [
            'user' => $user, 
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'form' => $form->createView(),
            'typeForm' => 'Edit '.$course->getCaption()
        ]);
    }

    /**
     * @Route("/editor/course/add", name="editor.course.add")
     */
    public function add(Request $request, FileUploader $fileUploader)
    {
        $user = $this->security->getUser();

        $course = new Course();
        $form = $this->createForm(CourseType::class, $course, [
            'admin' => $user->getIdRole()->getIdRole() == $this->getParameter('user.idRole.admin') ? true : false
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if(!is_null($form->get('image')->getData())){
                $filename = $fileUploader->uploadFile($form->get('image')->getData());
                $course->setFilelink($filename);
            }
            $this->em->persist($course);
            $this->em->flush();
            $this->em->clear();
            return $this->redirectToRoute('editor.course.list');
        }
        return $this->render('editor/course/edit.html.twig', [
            'user' => $user, 
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'form' => $form->createView(),
            'typeForm' => 'Add course'
        ]);
    }

    /**
     * @Route("/editor/course/duplicate/{id}", name="editor.course.duplicate", requirements={"id"="\d+"})
     */
    public function duplicate(Course $course, Request $request, FileUploader $fileUploader, ChapterRepository $chapterRepository)
    {
        $user = $this->security->getUser();

        $courseDuplicate = new Course();
        $courseDuplicate->setCaption($course->getCaption())
            ->setDescription($course->getDescription())
            ->setIdCategory($course->getIdCategory())
            ->setIdUser($course->getIdUser())
            ->setActive($course->getActive())
        ;

        $form = $this->createForm(CourseType::class, $courseDuplicate, [
            'admin' => $user->getIdRole()->getIdRole() == $this->getParameter('user.idRole.admin') ? true : false
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!is_null($form->get('image')->getData())){
                $filename = $fileUploader->uploadFile($form->get('image')->getData());
                $courseDuplicate->setFilelink($filename);
            }
            $this->em->persist($courseDuplicate);
            $this->em->flush();
            $this->em->clear();
            return $this->redirectToRoute('editor.course.list');
        }
        return $this->render('editor/course/edit.html.twig', [
            'user' => $user, 
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'form' => $form->createView(),
            'typeForm' => 'Duplicate '.$courseDuplicate->getCaption()
        ]);
    }
}
