<?php

namespace App\Controller\Editor;

use App\Entity\Course;
use App\Form\Editor\CourseType;
use App\Services\FileUploader;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
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

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(Security $security, CategoryRepository $categoryRepository, ManagerRegistry $managerRegistry)
    {
        $this->security = $security;
        $this->categoryRepository = $categoryRepository;
        $this->em = $managerRegistry->getManager();
    }

    /**
     * @Route("/editor/course/list", name="editor.course.list")
     * 
     * @return Response
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
     * 
     * @param Course $course
     * @param Request $request
     * @param FileUpload $fileUploader
     * @return Response
     */
    public function edit(Course $course, Request $request, FileUploader $fileUploader): Response
    {
        $user = $this->security->getUser();
        if($user->getIdRole()->getIdRole() != $this->getParameter('user.idRole.admin') && $user != $course->getIdUser()){ // if the user isn't autorize to edit this course
            return $this->redirectToRoute('editor.course.list');
        }

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
     * 
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function add(Request $request, FileUploader $fileUploader): Response
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
     * 
     * @param Course $course
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function duplicate(Course $course, Request $request, FileUploader $fileUploader): Response
    {
        $user = $this->security->getUser();

        if($user->getIdRole()->getIdRole() != $this->getParameter('user.idRole.admin') && $user != $course->getIdUser()){ // if the user isn't autorize to edit this course
            return $this->redirectToRoute('editor.course.list');
        }

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