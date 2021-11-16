<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    /**
     * @Route("/course/list", name="listCourse")
     */
    public function list(): Response
    {
        return $this->render('user/course/index.html.twig');
    }

    /**
     * @Route("/course/edit", name="editCourse")
     */
    public function edit(): Response
    {
        return $this->render('editor/course/index.html.twig');
    }

    /**
     * @Route("/course/add", name="addCourse")
     */
    public function add(): Response
    {
        return $this->render('editor/course/index.html.twig');
    }
}
