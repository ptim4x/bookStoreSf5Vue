<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('bookWatt Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Revenir à l\'accueil', 'fa fa-home', '/');
        yield MenuItem::linkToUrl('Aller à l\'API', 'fa fa-plug', '/api');
        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Genres', 'fas fa-list', Genre::class);
    }
}
