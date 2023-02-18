<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/categories', name: 'categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/{slug}', name: 'list')]
    public function list(Categories $categories): Response
    {
        //liste produit de la categorie
        $products = $categories->getProducts();

        return $this->render('categories/liste.html.twig',compact('categories' , 'products'));
    }
}
