<?php

namespace App\Controller;

use App\Repository\TypeNftRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class NftTypeController extends AbstractController
{
    public function __construct(private TypeNftRepository $typeRepository){

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
    public function updateType($id)
    {
        
    }
    #[Route('/nft_type_add/{id}', name: 'app_nft_type_add')]
    public function addType($id)
    {
        
    }
}
