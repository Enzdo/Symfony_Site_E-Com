<?php
namespace App\Services;

use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderService
{
    private RequestStack $requestStack;

    private EntityManagerInterface $em;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em )
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    public function addToOrder(int $id)
    {
        $card = $this->requestStack->getSession()->get('order', []);
            if(!empty($card[$id])){
                $card[$id]++;
            }else{
                $card[$id] = 1;
            }
        $this->getSession()->set('order', $card);
    }

    public function getTotal() : array
    {
        $card = $this->getSession()->get('order');
        $cardData = [];
        if($card){
            foreach($card as $id => $quantity){
                $product = $this->em->getRepository(Products::class)->findOneBy(['id' => $id]);
                if(!$product){
                    //supp produit puis continuer en sortant de la boucle
                }
                $cardData[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
            }
        }
        return $cardData;
    }


    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}