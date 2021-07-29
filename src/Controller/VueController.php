<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VueController extends AbstractController
{
    /**
     * @Route("/app/{route}", requirements={"route"=".*"}, name="vue")
     */
    public function index(): Response
    {
        return $this->render('vue/index.html.twig', [
            'title' => 'BookWatt',
            'main_technos' => ['Symfony 5.3', 'Api-platform 2.3', 'Vuejs 2.6', 'Bootstrap-vue 2.21 (Bootstrap 5.0)', 'Docker (Php 8.0 / Nginx 1.21 / Posgresql 13.3)']
        ]);
    }
}
