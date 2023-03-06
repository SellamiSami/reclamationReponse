<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }

    #[Route('/list_commande', name: 'list_commande')]
    public function ListCommande(): Response
    {
        return $this->render('commande/back/list_commande.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
}
