<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/list_produit', name: 'list_produit')]
    public function ListProduit(): Response
    {
        return $this->render('produit/back/list_produit.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
}
