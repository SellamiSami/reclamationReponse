<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegimeController extends AbstractController
{
    #[Route('/regime', name: 'app_regime')]
    public function index(): Response
    {
        return $this->render('regime/index.html.twig', [
            'controller_name' => 'RegimeController',
        ]);
    }

    #[Route('/list_regime', name: 'list_regime')]
    public function ListRegime(): Response
    {
        return $this->render('regime/back/list_regime.html.twig', [
            'controller_name' => 'RegimeController',
        ]);
    }
}
