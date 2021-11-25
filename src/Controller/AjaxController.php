<?php

namespace App\Controller;

use App\Service\AjaxResponseJson;
use App\Repository\CourseRepository;
use App\Repository\ChapterRepository;
use Doctrine\Persistence\ManagerRegistry; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->em = $managerRegistry->getManager();
    }
    
    

    /**
     * @Route("/ajax/course/getJson", name="getCourseJson")
     */
    public function courseJson(CourseRepository $courseRepository, AjaxResponseJson $ajaxResponseJson, Security $security): JsonResponse
    {
        $user = $security->getUser();
        if (is_null($user) ? 0 : $user->getIdRole()->getIdRole() == $this->getParameter('user.idRole.admin'))
            $courses = $courseRepository->getListCourse($user, true);
        else
            $courses = $courseRepository->getListCourse($user, false);
        return new JsonResponse($ajaxResponseJson->listCourseEditor($courses));
    }

    /**
     * @Route("/ajax/course/changeActive", name="changeActiveCourse")
     */
    public function changeActiveCourse(Request $request, CourseRepository $courseRepository): Response
    {
        $course = $courseRepository->find($request->request->get('id'));
        $course->setActive(!$course->getActive());
        $this->em->persist($course);
        $this->em->flush();
        $this->em->clear();
        return new Response('');
    }

    /**
     * @Route("/ajax/chapter/getJson/{idCourse}", name="getChapterJson", requirements={"idCourse"="\d+"})
     */
    public function chapterJson(int $idCourse, ChapterRepository $chapterRepository, AjaxResponseJson $ajaxResponseJson): JsonResponse
    {
        $chapters = $chapterRepository->getListChapter($idCourse);
        dd($chapters);
        return new JsonResponse($ajaxResponseJson->listChapterEditor($chapters));
    }
}
