<?php

namespace App\Controller;
use App\Entity\Reclamation;
use App\Repository\ReclamationRepository;
use App\Form\ReclamtionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use TCPDF;

class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(Request $request,ReclamationRepository $reclamationRepository,PaginatorInterface $paginator): Response
    {
        $reclamationRepository = $this->getDoctrine()->getRepository(Reclamation::class)->findall();
        $reclamationRepository = $paginator->paginate(
            $reclamationRepository,
            $request->query->getInt('page',1),
            4


        );
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }


    
    }
    #[Route('/list_reclamation', name: 'list_reclamation')]
    public function ListReclamation(Request $request,ReclamationRepository $reclamationRepository,PaginatorInterface $paginator): Response
    {
        $reclamationRepository = $this->getDoctrine()->getRepository(Reclamation::class)->findall();
        $reclamationRepository = $paginator->paginate(
            $reclamationRepository,
            $request->query->getInt('page',1),
            4


        );
        return $this->render('reclamation/back/list_reclamation.html.twig', [
            'reclamation' => $reclamationRepository,
           
        ]);
    }
    #[Route('/list_reclamationFront', name: 'list_reclamationFront')]
    public function ListReclamationFront(ManagerRegistry $doctrine): Response
    {
        $reclamation = $doctrine
            ->getRepository(Reclamation::class)
            ->findAll();

        return $this->render('reclamation/front/list_reclamation_front.html.twig', [
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
              $this->addflash(
                'info',
                'Element ajouté avec succès'
              );

              return $this->redirectToRoute('list_reclamation');
          }
        return $this->renderForm('reclamation/back/add_reclamation.html.twig', [
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
        $this->addflash(
            'info',
            'Element supprimer avec succès'
          );
        return $this->redirectToRoute('list_reclamation');

    }

    #[Route('/delete2_reclamation{id_reclamation}', name: 'delete2_reclamation')]
    public function DeleteReclamationF(ManagerRegistry $doctrine,$id_reclamation): Response
    {
        $reclamation = $doctrine
            ->getRepository(Reclamation::class)
            ->find($id_reclamation);
        $em = $doctrine->getManager();
        $em->remove($reclamation);
        $em->flush();
        $this->addflash(
            'info',
            'Element supprimer avec succès'
          );
        return $this->redirectToRoute('list_reclamationFront');

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
            $this->addflash(
                'info',
                'Element modifié avec succès'
              );
            return $this->redirectToRoute('list_reclamation');
        }
        return $this->renderForm('reclamation/back/update_reclamation.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/update2_reclamation{id_reclamation}', name: 'update2_reclamation')]
    public function UpdateReclamationF(ManagerRegistry $doctrine,Request  $resquest,$id_reclamation): Response
    {
        $reclamation =$doctrine->getRepository(Reclamation::class)->find($id_reclamation);
        $form = $this->createForm(ReclamtionType::class, $reclamation);
        $form->handleRequest($resquest);

        if($form->isSubmitted())
        {
            $em = $doctrine->getManager();
            $em->persist($reclamation);
            $em->flush();
            $this->addflash(
                'info',
                'Element modifié avec succès'
              );
            return $this->redirectToRoute('list_reclamationFront');
        }
        return $this->renderForm('reclamation/back/update_reclamation.html.twig', [
            'form' => $form,
        ]);
    }
    // #[Route('/update_reclamationFront{id_reclamation}', name: 'update_reclamationFront')]
    // public function UpdateReclamationFront(ManagerRegistry $doctrine,Request  $resquest,$id_reclamation): Response
    // {
    //     $reclamation =$doctrine->getRepository(Reclamation::class)->find($id_reclamation);
    //     $form = $this->createForm(ReclamtionType::class, $reclamation);
    //     $form->handleRequest($resquest);

    //     if($form->isSubmitted())
    //     {
    //         $em = $doctrine->getManager();
    //         $em->persist($reclamation);
    //         $em->flush();

    //         return $this->redirectToRoute('list_reclamationFRont');
    //     }
    //     return $this->renderForm('reclamation/back/update_reclamation.html.twig', [
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/add_reclamationFront', name: 'add_reclamationFront')]
    public function AddReclamationFront(ManagerRegistry $doctrine,Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamtionType::class, $reclamation);

        $form->handleRequest($request);

          if($form->isSubmitted()and $form->isValid())
          
          {
              $em = $doctrine->getManager();
              $em->persist($reclamation);
              $em->flush();

               return $this->redirectToRoute('list_reclamationFront');
          }
           
          
        return $this->renderForm('reclamation/front/add_reclamation_front.html.twig', [
            'form' => $form,
        ]);
    }
    
    

    #[Route("/pdf/reclamation", name:"pdf_reclamations")]
    public function PdfReclamation()
    {
        // Récupérer la liste des reclamations depuis la base de données
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        if (empty($reclamation)) {
            throw $this->createNotFoundException('Aucune réclamation trouvée.');
        }
        // Générer le contenu du PDF avec la liste des reclamations
        $html = $this->renderView('reclamation/back/list_pdf.html.twig', [
            'reclamation' => $reclamation,
        ]);

        // Récupérer l'heure actuelle
        $date = new \DateTime();
        $heure = $date->format('d/m/Y H:i:s');

        // Créer une nouvelle instance de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Définir les propriétés du document PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Mon application');
        $pdf->SetTitle('Liste des reclamations');
        $pdf->SetSubject('Liste des reclamations');
        $pdf->SetKeywords('Liste, reclamations');

        

        // Ajouter une page au document PDF
        $pdf->AddPage();


        
        // Écrire le contenu HTML dans le document PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        


        // Ajouter l'heure en bas de la dernière page
        $pdf->SetY(260);
        $pdf->SetFont('helvetica', 'I', 12);
        $pdf->Cell(0, 10, 'Date et heure de création : ' . $heure, 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // Générer le fichier PDF et l'envoyer au navigateur
        return new Response($pdf->Output('Liste des reclamations.pdf', 'I'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Liste des reclamations.pdf"',
        ]);
    }
//}
} 
