<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategoryUpdateType;

#[Route('/admin')]
class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository,
                                private EntityManagerInterface $categoryManager){

    }
    #[Route('/categories_show', name: 'app_categories_show')]
    public function index(): Response
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    #[Route('/categories_remove/{id}', name: 'app_category_remove')]
    public function removeCategory($id){
        
        
    }

    #[Route('/categories_add', name: 'app_category_add')]
    public function addCategory(Request $request){
        $category = new Category();
        $form = $this->createForm(categoryUpdateType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->categoryManager->persist($category);
            $this->categoryManager->flush();
            return $this->redirectToRoute('app_categories_show');
        }
        return $this->render('category/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/categories_update/{id}', name: 'app_category_update')]
    public function updateCategory($id, Request $request){
        $category = $this->categoryRepository->find($id);
        $form = $this->createForm(categoryUpdateType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->categoryManager->persist($category);
            $this->categoryManager->flush();
            return $this->redirectToRoute('app_categories_show');
        }
        return $this->render('category/update.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
