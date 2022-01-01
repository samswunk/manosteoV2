<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\Facture;
use App\Entity\Patient;
use App\Form\ConsultationType;
use App\Form\PatientType;
use App\Repository\ConsultationRepository;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Services\DecryptService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/patient")
 */
class PatientController extends AbstractController
{
    
    public function __construct(ConsultationRepository $consultationRepository,ObjectNormalizer $serializer,DecryptService $decryptService)
    {
        $this->consultationRepository = $consultationRepository;
        $this->serializer = $serializer;
        $this->decryptService = $decryptService;
        // $this->entityManager = $this->getDoctrine()->getManager();
    }

    /**
     * @Route("/", name="patient_index", methods={"GET"})
     */
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('patient/index.html.twig', [
            'patients' => $patientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/test/{nom}", name="test", methods={"GET","POST"})
     */
    public function test($nom): Response
    {
            return new JsonResponse(['data' => $this->decryptService->encrypt($nom)]);
    }
    
    /**
     * @Route("/new", name="patient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient,[]);
        $form->handleRequest($request);
        $listeConsultations = $this->consultationRepository->findBy(['patient'=>$patient]);
        if ($request->request->has('patient')) { $submittedToken = $request->request->get('patient')['_token']; }
        // dd($request->request);
        if ($form->isSubmitted() && ($form->isValid() || $this->isCsrfTokenValid('insert', $submittedToken))) {
            $entityManager = $this->getDoctrine()->getManager();
            $patient->setNom($this->decryptService->encrypt($patient->getNom()));
            $patient->setPrenom($this->decryptService->encrypt($patient->getPrenom()));
            $entityManager->persist($patient);
            $entityManager->flush();
            return $this->redirectToRoute('patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('patient/new.html.twig', [
            'listeConsultations'=> $listeConsultations,
            'patient'   => $patient,
            'form'      => $form->createView(),
            'titre'     => 'Nouveau patient', 
            'provenance'=> 'new'
        ]);
    }

    /**
     * @Route("/{id}", name="patient_show", methods={"GET"})
     */
    public function show(Patient $patient): Response
    {
        $form = $this->createForm(PatientType::class, $patient);

        return $this->render('patient/show.html.twig', [
            'patient'   => $patient,
            'form'      => $form->createView(),
            'titre'     => 'Fiche patient', 
            'provenance'=> 'show'
        ]);
    }

    /**
     * @Route("/edit/{id}/{origine}", name="patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Patient $patient, $origine): Response
    {
        $em = $this->getDoctrine()->getManager();
        // dd( $request,$patient,$request->request
        // ,$this->decryptService->encrypt($patient->getPrenom())
        // ,$this->decryptService->encrypt($patient->getNom())
        // );
        // if ($request->request->has('patient')) 
        // {
        //     $patientMaj = $request->request->get('patient');
        //     // dd($patientMaj,$patientMaj["adresse"]);
        //     // $patient->setAdresse        ($patientMaj["adresse"]);
        //     // $patient->SetTelephone      ($patientMaj["telephone"]);
        //     // $patient->SetRemarques      ($patientMaj["remarques"]);
        //     // $patient->SetAntecedents    ($patientMaj["antecedents"]);
        //     // $patient->SetAntecedent     ($patientMaj["antecedent"]);
        //     // $patient->SetAccouchement   ($patientMaj["accouchement"]);
        //     // $patient->SetPediatrie      ($patientMaj["pediatrie"]);
        //     // $patient->SetTraumato       ($patientMaj["traumato"]);
        //     $patient->setNom(   $this->decryptService->encrypt(trim($patientMaj["Nom"])   ));
        //     $patient->setPrenom($this->decryptService->encrypt(trim($patientMaj["prenom"])));
        //     $em->persist($patient);
        //     $em->flush();
        //     $request->request->set('patient', $patient);
        //     // $request->request->set('adresse', $patient->getAdresse());
        // }
        $form = $this->createForm(PatientType::class, $patient);
        // dd($form,$patient);
        // dd($request,$form,$patient);
        $form->handleRequest($request);
        // dd( $request,$patient,$request->request );
        $listeConsultations = $this->consultationRepository->findBy(['patient'=>$patient]);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            if ($request->request->has('consultation')) 
            {
                $consult        = $request->request->get('consultation');    
                $fact           = $consult["facture"];
                $facture        = new Facture();
                $consultation   = new Consultation();
                
                $facture->setTarif($fact["tarif"]);
                $facture->setPaiement($fact["paiement"]);
                $facture->setNumeroCheque($fact["numeroCheque"]);
                $facture->setRegler($fact["regler"]);
                
                $dateFact    =   \DateTime::createFromFormat("d/m/Y",$fact["date"]);
                $dateconsult    =   \DateTime::createFromFormat("d/m/Y",$consult["date"]);

                $dateT          =   $dateFact->format('Y-m-d') ;
                $dateT          =   $dateconsult->format('Y-m-d'); // new \DateTime($dateconsult);
                
                $facture->setDate($dateFact);
                $em->persist($facture);
                $consultation->setFacture($facture);

                $consultation->setDate($dateconsult);
                $consultation->setMotif($consult["motif"]);
                $consultation->setTest($consult["test"]);
                $consultation->setTraitement($consult["traitement"]);
                $consultation->setPatient($patient);
                $em->persist($consultation);
                $em->flush();
            }
            else
            {
                $this->getDoctrine()->getManager()->flush();
                // dd($form,$patient,$patientMaj["Nom"],$patientMaj["prenom"],$patient->getNom(), $patient->getPrenom()
                //     , $this->decryptService->decrypt($patientMaj["prenom"]));
                return $this->redirectToRoute('patient_edit', [
                        'id'        => $patient->getId(),
                        'origine'   => 'patient'
                ], Response::HTTP_SEE_OTHER);                
            }

            return $this->redirectToRoute('patient_index', [
                'patient'           => $patient,
            ], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('patient/edit.html.twig', [
            'listeConsultations'=> $listeConsultations,
            'patient'           => $patient,
            'origine'           => $origine ?? 'patient',
            'form'              => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_delete", methods={"POST"})
     */
    public function delete(Request $request, Patient $patient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patient_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/consultations/{id}", name="consultations_liste", methods={"GET"})
     */
    public function listeConsultations(Patient $patient): Response
    {
        $listeConsultations = $this->consultationRepository->findBy(['patient'=>$patient], ['date' => 'DESC']);
        $form = $this->createForm(PatientType::class, $patient);
        return $this->render('patient/listeConsultations.html.twig', [
            'listeConsultations'=> $listeConsultations,
            'patient'           => $patient,
            'form'              => $form->createView()
        ]);
    }

}
