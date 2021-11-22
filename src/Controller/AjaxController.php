<?php

namespace App\Controller;

use App\Repository\CourseRepository;
use App\Service\AjaxResponseJson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AjaxController extends AbstractController
{
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
}
