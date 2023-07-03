<?php

namespace App\Controller;

use App\Repository\NftRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class NftController extends AbstractController
{
    public function __construct(private NftRepository $nftRepository,
                                private PaginatorInterface $paginator){

    }
    #[Route('/nfts_show', name: 'app_nfts_show')]
    public function index(Request $request): Response
    {
        $query = $this->nftRepository->getAll();
        $nfts = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10);
        return $this->render('nft/index.html.twig', [
            'nfts' => $nfts,
        ]);
    }
    #[Route('/nft_remove/{id}', name: 'app_nft_remove')]
    public function removeNft($id){

    }
    #[Route('/nft_update/{id}', name: 'app_nft_update')]
    public function updateNft($id){

    }
    #[Route('/nft_add/{id}', name: 'app_nft_add')]
    public function addNft($id){

    }
    #[Route('/nft_show/{id}', name: 'app_nft_show')]
    public function showNft($id){

    }
}
