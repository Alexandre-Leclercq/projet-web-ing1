<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Admin\UserType;
use App\Services\FileUploader;
use App\Repository\CategoryRepository;
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
     * @return Response
     */
    public function list()
    {
        return new Response('');
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
            $userPasswordHasherInterface->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );
            //dd($fileUploader->uploadFile($form->get('picture')->getData()));
            $filename = $fileUploader->uploadFile($form->get('picture')->getData());
            $user->setPictureFilelink($filename);
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

    // /**
    //  * @param Request $request
    //  * @return Response
    //  */
    // public function add(Request $request): Response
    // {   
    //     //try{
    //         $cpuManufacturer = new CpuManufacturer();
    //         $form = $this->createForm(AddCpuManufacturerType::class, $cpuManufacturer);
    //         $form->handleRequest($request);
    //         if($form->isSubmitted() && $form->isValid()){
    //             $this->em->persist($form->getData());
    //             $this->em->flush();
    //             $this->addFlash('success', $this->getParameter('message.admin.cpuManufacturer.add'));
    //             return $this->redirectToRoute('cpuManufacturer.list');
    //         }
    //         $screen = $this->screenRepository->find($this->getParameter('screen.admin.cpuManufacturer.id'));
    //         $menus = $this->userPermission->getMenu();
    //         return $this->render('admin/cpuManufacturer/edit.html.twig', [
    //             'current_menu_id' => is_null($screen->getIdMenu()) ? 0 : $screen->getIdMenu()->getIdMenu(),
    //             'current_screen_id' => $screen->getIdScreen(),
    //             'page_name' => $this->getParameter('page.admin.cpuManufacturer.list.title'),
    //             'user' => $this->security->getUser(),
    //             'site' => $request->getSession()->get('site'),
    //             'menus' => $menus,
    //             'siteNumber' => $request->getSession()->get('siteNumber'),
    //             'form' => $form->createView()
    //         ]);
    // }

    // /**
    //  * @param CpuManufacturer $cpuManufacturer
    //  * @param Request $request
    //  * @return Response
    //  */
    // public function duplicate(CpuManufacturer $cpuManufacturer, Request $request): Response
    // {   
    //     //try{
    //         $cpuManufacturerDuplicate = (new CpuManufacturer())->setCaption($cpuManufacturer->getCaption().$this->getParameter('app.duplicate.caption'))
    //             ->setComment($cpuManufacturer->getComment())
    //             ->setActive($cpuManufacturer->getActive());
    //         $form = $this->createForm(AddCpuManufacturerType::class, $cpuManufacturerDuplicate);
    //         $form->handleRequest($request);
    //         if($form->isSubmitted() && $form->isValid()){
    //             $this->em->persist($form->getData());
    //             $this->em->flush();
    //             $this->addFlash('success', $this->getParameter('message.admin.cpuManufacturer.add'));
    //             return $this->redirectToRoute('cpuManufacturer.list');
    //         }
    //         $screen = $this->screenRepository->find($this->getParameter('screen.admin.cpuManufacturer.id'));
    //         $menus = $this->userPermission->getMenu();
    //         return $this->render('admin/cpuManufacturer/edit.html.twig', [
    //             'current_menu_id' => is_null($screen->getIdMenu()) ? 0 : $screen->getIdMenu()->getIdMenu(),
    //             'current_screen_id' => $screen->getIdScreen(),
    //             'page_name' => $this->getParameter('page.admin.cpuManufacturer.list.title'),
    //             'user' => $this->security->getUser(),
    //             'site' => $request->getSession()->get('site'),
    //             'menus' => $menus,
    //             'siteNumber' => $request->getSession()->get('siteNumber'),
    //             'form' => $form->createView()
    //         ]);
    // }
}
