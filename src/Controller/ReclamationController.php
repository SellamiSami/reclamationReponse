<?php

namespace App\Controller;
use App\Entity\Reclamation;
use App\Form\ReclamtionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;

class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(): Response
    {
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }


    
    }
    #[Route('/list_reclamation', name: 'list_reclamation')]
    public function ListReclamation(ManagerRegistry $doctrine): Response
    {
        $reclamation = $doctrine
            ->getRepository(Reclamation::class)
            ->findAll();

        return $this->render('reclamation/back/list_reclamation.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    
     
   

    #[Route('/add_reclamation', name: 'add_reclamation')]
    public function AddReclamation(ManagerRegistry $doctrine,Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamtionType::class, $reclamation);

        $form->handleRequest($request);

          if($form->isSubmitted()and $form->isValid())
          {
              $em = $doctrine->getManager();
              $em->persist($reclamation);
              $em->flush();

              return $this->redirectToRoute('list_reclamation');
          }
        return $this->renderForm('reclamation/add_reclamation.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/delete_reclamation{id_reclamation}', name: 'delete_reclamation')]
    public function DeleteReclamation(ManagerRegistry $doctrine,$id_reclamation): Response
    {
        $reclamation = $doctrine
            ->getRepository(Reclamation::class)
            ->find($id_reclamation);
        $em = $doctrine->getManager();
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('list_reclamation');

    }
    #[Route('/update_reclamation{id_reclamation}', name: 'update_reclamation')]
    public function UpdateReclamation(ManagerRegistry $doctrine,Request  $resquest,$id_reclamation): Response
    {
        $reclamation =$doctrine->getRepository(Reclamation::class)->find($id_reclamation);
        $form = $this->createForm(ReclamtionType::class, $reclamation);
        $form->handleRequest($resquest);

        if($form->isSubmitted())
        {
            $em = $doctrine->getManager();
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('list_reclamation');
        }
        return $this->renderForm('reclamation/front/update_reclamation.html.twig', [
            'form' => $form,
        ]);
    }
    
}
