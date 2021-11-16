<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Security $security): Response
    {
        $user = $security->getUser(); // get current user login
        if(is_null($user)){
            return $this->render('index.html.twig');
        } else {
            return $this->render('user/index.html.twig', [
                'user' => $user
            ]);
        }
    }
}
