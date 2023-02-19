<?php

namespace App\Controller;

use App\Services\OrderService;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

    #[Route('/mon-panier', name: 'order_index')]
    public function index(OrderService $orderService): Response
    {   
        dd($orderService->getTotal());
        return $this->render('order/index.html.twig',[
            'cart' => $orderService->getTotal()
        ]);
    }

    #[Route('/mon-panier/add/{id<\d+>}', name: 'order_add')]
    public function addToRoute(OrderService $orderService, int $id): Response
    {
        $orderService->addToOrder($id);

        return $this->redirectToRoute('order_index');
    }
}
