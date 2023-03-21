<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\Users;
use App\Entity\Products;
use App\Entity\Categories;
use App\Entity\Coupons;

class adminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN' and 'ROLE_SUPER_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function __construct(AuthorizationCheckerInterface $authChecker)
    {
        $this->authChecker = $authChecker;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('La Religieuse a moteur - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Users::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-cookie-bite', Products::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categories::class);
        if ($this->authChecker->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToCrud('Coupons', 'fas fa-list', Coupons::class)
                ->setPermission('ROLE_SUPER_ADMIN');
        }
    }
}
