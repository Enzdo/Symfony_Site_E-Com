<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CategoriesRepository $categoriesRepository, ProductsRepository $productsRepository): Response
    {
        $categories = $categoriesRepository->findAll();
        $products = $productsRepository->findAll();
        return $this->render('main/index.html.twig', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}