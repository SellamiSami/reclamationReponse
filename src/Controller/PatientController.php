<?php

namespace App\Controller;


use App\Entity\Patient;
use App\Form\PatientType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_patient')]
    public function index(): Response
    {
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
        ]);
    }


    #[Route('/list_patient', name: 'list_patient')]
    public function ListPatient(ManagerRegistry $doctrine): Response
    {
        $patient = $doctrine
            ->getRepository(Patient::class)
            ->findAll();
        return $this->render('patient/back/list_patient.html.twig', [
            'patient' => $patient,
        ]);
    }

    #[Route('/add_patient', name: 'add_patient')]
    public function AddPatient(ManagerRegistry $doctrine,Request $request): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);

        $form->handleRequest($request);

          if($form->isSubmitted()and $form->isValid())
          {
              $em = $doctrine->getManager();
              $em->persist($patient);
              $em->flush();

              return $this->redirectToRoute('list_patient');
          }
        return $this->renderForm('patient/front/add_patient.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete_patient{id}', name: 'delete_patient')]
    public function DeletePatient(ManagerRegistry $doctrine,$id): Response
    {
        $patient = $doctrine
            ->getRepository(Patient::class)
            ->find($id);
        $em = $doctrine->getManager();
        $em->remove($patient);
        $em->flush();
        return $this->redirectToRoute('list_patient');

    }

    #[Route('/update_patient{id}', name: 'update_patient')]
    public function UpdatePatient(ManagerRegistry $doctrine,Request  $resquest,$id): Response
    {
        $patient =$doctrine->getRepository(Patient::class)->find($id);
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($resquest);

        if($form->isSubmitted())
        {
            $em = $doctrine->getManager();
            $em->persist($patient);
            $em->flush();

            return $this->redirectToRoute('list_patient');
        }
        return $this->renderForm('patient/front/update_patient.html.twig', [
            'form' => $form,
        ]);
    }
}
