<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserUpdateType;
use App\Repository\NftRepository;

#[Route('/admin')]
class UserController extends AbstractController
{
    public function __construct(private UserRepository $userRepository,
                                private NftRepository $nftRepository,
                                private PaginatorInterface $paginator,
                                private EntityManagerInterface $userManager){

    }
    #[Route('/users_show', name: 'app_users_show')]
    public function index(Request $request): Response
    {
        $query = $this->userRepository->getAll();  

        $users = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );      
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
    #[Route('/user_update/{id}', name: 'app_user_update')]
    public function updateUser($id, Request $request){
        $user = $this->userRepository->find($id);
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //$file = $request->files->get('user_update')['avatarPath'];
            //$fileName = $file->getClientOriginalName();
            //$user->setAvatar('upload/'.$fileName);
            $this->userManager->persist($user);
            $this->userManager->flush();
            return $this->redirectToRoute('app_users_show');
        }
        return $this->render('user/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/user_remove/{id}', name: 'app_user_remove')]
    public function removeUser($id){
        $user = $this->userRepository->find($id);
        $this->userManager->remove($user);
        $this->userManager->flush();
        return $this->redirectToRoute('app_users_show');
    }


    #[Route('/user_show/{id}', name: 'app_user_show')]
    public function showUser($id, Request $request){
        $user = $this->userRepository->find($id);
        $nfts = $this->paginator->paginate(
            $user->getNfts(),
            $request->query->getInt('page', 1),
            10
        );      
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'nfts' => $nfts,
        ]);
    }
}
