<?php

namespace App\Controller;

use App\Entity\CourseStatus;
use App\Service\AjaxResponseJson;
use App\Repository\CourseRepository;
use App\Repository\ChapterRepository;
use App\Repository\CourseStatusRepository;
use App\Repository\UserRepository;
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

    // ADMIN

    /**
     * @Route("/ajax/user/getJson", name="getUserJson")
     * 
     * @param AjaxResponseJson $ajaxResponseJson
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function userJson(AjaxResponseJson $ajaxResponseJson, UserRepository $userRepository): JsonResponse
    {
        return new JsonResponse($ajaxResponseJson->listUserEditor($userRepository->findAll()));
    }

    /**
     * @Route("/ajax/user/changeActive", name="changeActiveUser")
     * 
     * @param Request $request
     * @param UserRepository $userRepository
     * 
     * @return Response
     */
    public function changeActiveUser(Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($request->request->get('id'));
        $user->setActive(!$user->getActive());
        $this->em->persist($user);
        $this->em->flush();
        $this->em->clear();
        return new Response(null);
    }
    
    // EDITOR

    /**
     * @Route("/ajax/course/getJson", name="getCourseJson")
     * 
     * @param CourseRepository $courseRepository
     * @param AjaxResponseJson $ajaxResponseJson
     * @param Security $security
     * @return JsonResponse
     */
    public function courseJson(CourseRepository $courseRepository, AjaxResponseJson $ajaxResponseJson, Security $security): JsonResponse
    {
        $user = $security->getUser();
        if (is_null($user) ? 0 : $user->getIdRole()->getIdRole() == $this->getParameter('user.idRole.admin'))
            $courses = $courseRepository->getListEditorCourse($user, true);
        else
            $courses = $courseRepository->getListEditorCourse($user, false);
        return new JsonResponse($ajaxResponseJson->listCourseEditor($courses));
    }

    /**
     * @Route("/ajax/course/changeActive", name="changeActiveCourse")
     * 
     * @param Request $request
     * @param CourseRepository $courseRepository
     * @return Response
     */
    public function changeActiveCourse(Request $request, CourseRepository $courseRepository): Response
    {
        $course = $courseRepository->find($request->request->get('id'));
        $course->setActive(!$course->getActive());
        $this->em->persist($course);
        $this->em->flush();
        $this->em->clear();
        return new Response(null);
    }

    /**
     * @Route("/ajax/course/changeStarred", name="changeStarredCourse")
     * 
     * @param Request $request
     * @param CourseStatusRepository $courseStatusRepository
     * @param UserRepository $userRepository
     * @return Response
     */
    public function changeStarredCourse(Request $request, CourseStatusRepository $courseStatusRepository, CourseRepository $courseRepository, UserRepository $userRepository): Response
    {
        $courseStatus = $courseStatusRepository->findOneBy(['idUser' => $request->request->get('idUser'), 'idCourse' => $request->request->get('idCourse')]);
        if(is_null($courseStatus)){
            $courseStatus = (new CourseStatus())
                ->setIdCourse($courseRepository->find($request->request->get('idCourse')))
                ->setIdUser($userRepository->find($request->request->get('idUser')))
                ->setStarred(true);
        } else {
            $courseStatus->setStarred(!$courseStatus->getStarred());
        }
        $this->em->persist($courseStatus);
        $this->em->flush();
        $this->em->clear();
        return new Response($courseStatus->getStarred());
    }

    /**
     * @Route("/ajax/chapter/getJson/{idCourse}", name="getChapterJson", requirements={"idCourse"="\d+"})
     * 
     * @param int $idCourse
     * @param ChapterRepository $chapterRepository
     * @param AjaxResponseJson $ajaxResponseJson
     * @return JsonResponse
     */
    public function chapterJson(int $idCourse, ChapterRepository $chapterRepository, AjaxResponseJson $ajaxResponseJson): JsonResponse
    {
        $chapters = $chapterRepository->getListChapter($idCourse);
        return new JsonResponse($ajaxResponseJson->listChapterEditor($chapters));
    }

    /**
     * @Route("/ajax/course/changeActiveChapter", name="changeActiveChapter")
     * 
     * @param Request $request
     * @param ChapterRepository $chapterRepository
     * @return Response
     */
    public function changeActiveChapter(Request $request, ChapterRepository $chapterRepository): Response
    {
        $chapter = $chapterRepository->find($request->request->get('id'));
        $chapter->setActive(!$chapter->getActive());
        $this->em->persist($chapter);
        $this->em->flush();
        $this->em->clear();
        return new Response(null);
    }
}
