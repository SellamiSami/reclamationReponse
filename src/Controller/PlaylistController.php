<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaylistController extends AbstractController
{
    #[Route('/playlist', name: 'app_playlist')]
    public function index(): Response
    {
        return $this->render('playlist/index.html.twig', [
            'controller_name' => 'PlaylistController',
        ]);
    }

    #[Route('/list_playlist', name: 'list_playlist')]
    public function ListPlaylist(): Response
    {
        return $this->render('playlist/back/list_playlist.html.twig', [
            'controller_name' => 'PlaylistController',
        ]);
    }
}
