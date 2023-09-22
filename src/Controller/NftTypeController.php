<?php

namespace App\Controller;

use App\Entity\NftType;
use App\Form\NftTypeUpdateType;
use App\Repository\NftTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin')]
class NftTypeController extends AbstractController
{
    public function __construct(private EntityManagerInterface $nftTypeManager,
    private NftTypeRepository $typeRepository){

    }
    #[Route('/nft_type', name: 'app_nft_type_show')]
    public function index(): Response
    {
        $types = $this->typeRepository->findAll();
        return $this->render('nft_type/index.html.twig', [
            'types' => $types,
        ]);
    }
    #[Route('/nft_type_remove/{id}', name: 'app_nft_type_remove')]
    public function removeType($id)
    {
        
    }
    #[Route('/nft_type_update/{id}', name: 'app_nft_type_update')]
    public function updateType($id, Request $request)
    {
        $nft_type = $this->typeRepository->find($id);
        $form = $this->createForm(NftTypeUpdateType::class, $nft_type);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->nftTypeManager->persist($nft_type);
            $this->nftTypeManager->flush();
            return $this->redirectToRoute('app_nft_type_show');
        }
        return $this->render('nft_type/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/nft_type_add', name: 'app_nft_type_add')]
    public function addType(Request $request)
    {
        $nftType = new NftType();
        $form = $this->createForm(NftTypeUpdateType::class, $nftType);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->nftTypeManager->persist($nftType);
            $this->nftTypeManager->flush();
            return $this->redirectToRoute('app_nft_type_show');
        }
        return $this->render('nft_type/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
