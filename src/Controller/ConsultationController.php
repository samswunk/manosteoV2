<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\Patient;
use App\Form\AddConsultationType;
use App\Form\ConsultationType;
use App\Form\PatientType;
use App\Repository\ConsultationRepository;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/consultation")
 */
class ConsultationController extends AbstractController
{
    
    public function __construct(ConsultationRepository $consultationRepository,PatientRepository $patientRepository)
    {
        $this->consultationRepo = $consultationRepository;   
        $this->patientRepo = $patientRepository;   
    }
    
    /**
     * @Route("/squelette", name="consultation_squelette", methods={"GET"})
     */
    public function squelette(): Response
    {
        return $this->render('consultation/localisation.html.twig', [
            'consultations' => $this->consultationRepo->findAll(),
        ]);
    }

    /**
     * @Route("/", name="consultation_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('consultation/index.html.twig', [
            'consultations' => $this->consultationRepo->findAll(),
        ]);
    }

    /**
     * @Route("/addConsultation/{idPatient}", name="addConsultation", methods={"GET","POST"})
     */
    public function addConsultation(Request $request,$idPatient): Response
    {
        $consultation = new Consultation();
        $patient = $this->patientRepo->findOneBy(['id'=>$idPatient]);
        $consultation->setPatient($patient);
        
        $form = $this->createForm(AddConsultationType::class, $consultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();
            // dd($consultation,$patient);
            return $this->redirectToRoute('consultations_liste', [
                'id'=>$idPatient
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consultation/addConsultation.html.twig', [
            'consultation'  => $consultation,
            'patient'       => $patient,
            'form'          => $form->createView(),
        ]);
    }
    /**
     * @Route("/new", name="consultation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $consultation = new Consultation();
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();

            return $this->redirectToRoute('consultation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consultation/new.html.twig', [
            'consultation' => $consultation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idPatient}", name="listeConsultation", methods={"GET"})
     */
    public function listeConsult($idPatient): Response
    {
        $patient = $this->patientRepo->findOneBy(['id'=>$idPatient]);
        $listeConsultations = $this->consultationRepo->findBy(['patient'=>$patient]);
        
        $form = $this->createForm(PatientType::class, $patient);

        // dd($consultation,$patient);
        // return $this->render('consultation/show.html.twig', [
        return $this->render('consultation/addConsultation.html.twig', [
        // return $this->render('patient/edit.html.twig', [
            'listeConsultations'    => $listeConsultations,
            'patient'               => $patient,
            'form'                  => $form->createView(), 
            'titre'                 => 'Liste des consultations'
        ]);
    }
    
    /**
     * @Route("/{id}", name="consultation_show", methods={"GET"})
     */
    public function show(Consultation $consultation): Response
    {
        return $this->render('consultation/show.html.twig', [
            'consultation' => $consultation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="consultation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Consultation $consultation): Response
    {
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('consultation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('consultation/edit.html.twig', [
            'consultation' => $consultation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consultation_delete", methods={"POST"})
     */
    public function delete(Request $request, Consultation $consultation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consultation->getId(), $request->request->get('_token'))) 
        {
            $patient = $consultation->getPatient();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($consultation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('consultations_liste', [
                'id'=> $patient->getId()
        ], Response::HTTP_SEE_OTHER);
    }
}
