<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Admin\UserType;
use App\Services\FileUploader;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
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
     * @Route("/admin/user/list", name="admin.user.list")
     */
    public function list(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/list.html.twig', [
            'user' => $this->security->getUser(), 
            'categories' => $this->categoryRepository->findBy(['active' => true])
        ]);
    }

    /**
     * @Route("/admin/user/edit/{id}", name="admin.user.edit", requirements={"id"="\d+"})
     * 
     * @param User $user
     * @param Request $request
     * @param UserPasswordHasherInterface $userPasswordHasherInterface
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function edit(User $user, Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, FileUploader $fileUploader): Response
    {   
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!is_null($form->get('plainPassword')->getData())){
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                );
            }
            if(!is_null($form->get('picture')->getData())){
                $filename = $fileUploader->uploadFile($form->get('picture')->getData());
                $user->setPictureFilelink($filename);
            }
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('admin.user.list');
        }
        return $this->render('admin/user/edit.html.twig', [
            'user' => $this->security->getUser(), 
            'categories' => $this->categoryRepository->findBy(['active' => true]),
            'form' => $form->createView()
        ]);
    }
}
