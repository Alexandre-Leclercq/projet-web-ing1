<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class IndexController extends AbstractController
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
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $user = $this->security->getUser(); // get current user login

        $categories = $this->categoryRepository->findBy(['active' => true]);
        if(is_null($user)){
            return $this->render('index.html.twig');
        } else {
            return $this->render('user/index.html.twig', [
                'user' => $user,
                'categories' => $categories
            ]);
        }
    }
}
