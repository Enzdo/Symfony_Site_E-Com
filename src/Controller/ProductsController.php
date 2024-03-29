<?php

namespace App\Controller;

use App\Entity\Products;
use App\Services\OrderService;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/products', name: 'products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('products/index.html.twig');
    }

    #[Route('/{slug}', name: 'details')]
    public function details(Products $product, ProductsRepository $productsRepository): Response
    {   
        $products_other = $productsRepository->findAll();
        return $this->render('products/details.html.twig', compact('product', 'products_other'));
    }
}