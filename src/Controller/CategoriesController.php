<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories', name: 'categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/{slug}', name: 'list')]
    public function list(Categories $categories, Request $request): Response
    {
        $products = $categories->getProducts();

        if ($request->query->get('sort') == 'asc') {
            $products = $products->toArray();
            usort($products, function($a, $b) {
                return $a->getPrice() - $b->getPrice();
            });
        }
        
        if ($request->query->get('sort') == 'desc') {
            $products = $products->toArray();
            usort($products, function($a, $b) {
                return $b->getPrice() - $a->getPrice();
            });
        }

        return $this->render('categories/liste.html.twig', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}