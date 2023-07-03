<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository){

    }
    #[Route('/categories_show', name: 'app_categories_show')]
    public function index(): Response
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    #[Route('/categories_remove/{id}', name: 'app_categories_remove')]
    public function removeCategory($id){
        
    }
    #[Route('/categories_update/{id}', name: 'app_categories_update')]
    public function updateCategory($id){

    }

}
