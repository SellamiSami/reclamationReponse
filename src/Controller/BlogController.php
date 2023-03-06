<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_bloc')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    #[Route('/list_blog', name: 'list_blog')]
    public function ListBlog(): Response
    {
        return $this->render('blog/back/list_blog.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}
