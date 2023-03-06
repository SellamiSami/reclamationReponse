<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedecinType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedecinController extends AbstractController
{
    #[Route('/medecin', name: 'app_medecin')]
    public function index(): Response
    {
        return $this->render('medecin/index.html.twig', [
            'controller_name' => 'MedecinController',
        ]);
    }


    #[Route('/list_medecin', name: 'list_medecin')]
    public function ListMedecin(ManagerRegistry $doctrine): Response
    {
        $medecin = $doctrine
            ->getRepository(Medecin::class)
            ->findAll();
        return $this->render('medecin/back/list_medecin.html.twig', [
            'medecin' => $medecin,
        ]);
    }

    #[Route('/add_Medecin', name: 'add_Medecin')]
    public function AddMedecin(ManagerRegistry $doctrine,Request $request): Response
    {
        $medecin = new Medecin();
        $form = $this->createForm(MedecinType::class, $medecin);

        $form->handleRequest($request);

        if($form->isSubmitted()and $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($medecin);
            $em->flush();

            return $this->redirectToRoute('list_medecin');
        }
        return $this->renderForm('medecin/front/add_medecin.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete_medecin{id}', name: 'delete_medecin')]
    public function DeleteMedecin(ManagerRegistry $doctrine,$id): Response
    {
        $medecin = $doctrine
            ->getRepository(Medecin::class)
            ->find($id);
        $em = $doctrine->getManager();
        $em->remove($medecin);
        $em->flush();
        return $this->redirectToRoute('list_medecin');

    }

    #[Route('/update_medecin{id}', name: 'update_medecin')]
    public function UpdateMedecin(ManagerRegistry $doctrine,Request  $resquest,$id): Response
    {
        $medecin =$doctrine->getRepository(Medecin::class)->find($id);
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($resquest);

        if($form->isSubmitted())
        {
            $em = $doctrine->getManager();
            $em->persist($medecin);
            $em->flush();

            return $this->redirectToRoute('list_medecin');
        }
        return $this->renderForm('medecin/front/update_medecin.html.twig', [
            'form' => $form,
        ]);
    }
}
