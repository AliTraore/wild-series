<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response 
    {

          $categories = $categoryRepository->findAll();
          return $this->render('category/index.html.twig',['categories' => $categories]);
    
    } 

    #[Route('/{categoryName}', name :'category_show')]
     public function show (string $categoryName , CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
     {
        // $categoryName = "Action" ou "Aventure" c'est égal à ce qui est passé dans url 
        $category = $categoryRepository->findOneBy(['name' => $categoryName]); // SELECT * FROM category WHERE name= 'Action'
        $programs = $programRepository->findBy(['category' => $category], ['id' => 'DESC'],3); // SELECT * FROM program LEFT JOIN category ON category.id = program.category_id 
        // category = category_id clé étrangère en sql 

        if (!$category) {
            throw $this->createNotFoundException(
                'No program with id : '.$category.' found in category table.'
            );
        }
        return $this->render('category/show.html.twig',['category' => $category, 'programs' => $programs]);

    }
}