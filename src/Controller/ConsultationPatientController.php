<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Consultation;
use App\Form\ConsultationType;
use App\Repository\UserRepository;
use App\Repository\ConsultationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/ateliers")
 */
class ConsultationPatientController extends AbstractController
{
    public function __construct(ConsultationRepository $consultationsRepository, UserRepository $userRepository)
    {
        $this->aR = $consultationsRepository;
        $this->users = $userRepository->findAll();
    }

    /**
     * @Route("/", name="ateliers_index", methods={"GET"})
     */
    public function index(): Response
    {
        $userRole = $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
        return $this->render('ateliers/index.html.twig', [
            'ateliers' => $this->aR->findAllAteliers($userRole),
            'titre'     => 'Liste des ateliers'
        ]);
    }
    
    /**
     * @Route("/detail/{idAtelier}", name="ateliers_detail", methods={"GET"})
     */
    public function atelierDetail($idAtelier): Response
    {
        $consultation    = $this->aR->find($idAtelier);
        // dd($consultation,$idAtelier,$consultation->getDate());
        return $this->render('ateliers/detail.html.twig', [
            'ateliers'          => $consultation,
            'users'             => $this->users,
            'idAtelier'         => $idAtelier,
            'date'              => $consultation->getDate() ,
            'jaugeAtelier'      => 1,
            'titre'             => 'Détail de l\'atelier '. $consultation->getDate(),
        ]);
    }

    /**
    * @Route("/ateliernbrmax/{idAtelier}/{ajout}", name="modif_nbrmax_atelier", methods={"GET"})
    */
    public function modifNbrmaxAtelier($idAtelier,$ajout): Response
    {
        $consultation   = $this->aR->find($idAtelier);
        $entityManager = $this->getDoctrine()->getManager();
        
        // dd('id:', $id,'idAtelier:',$idAtelier,'consultant:',$consultant,'invi:',$consultation);
        $nbrActuel=1;

        if($ajout) 
        {
            $consultation->setJauge($nbrActuel+1);
        }
        else 
        {
            if ($nbrActuel>0)
                {
                    $consultation->setJauge($nbrActuel-1);
                }
        }
        $entityManager->persist($consultation);
        $entityManager->flush();
        
        return $this->render('ateliers/detail.html.twig', [
            'ateliers'      => $consultation,
            'users'         => $this->users,
            'idAtelier'     => $idAtelier,
            'date'          => $consultation->getDate(),
            'jaugeAtelier'  => 1,
            'titre'         => 'Modification de l\'atelier '. $consultation->getDate(),
            'pages'     => $this->pagesRepository->findAll()
        ]);
    }

    /**
    * @Route("/atelier/{id}/{idAtelier}/{convoquer}", name="convoquer_pers", methods={"GET"})
    */
    public function convoquerPersonne($id,$idAtelier,$convoquer): Response
    {
        $consultation   = $this->aR->find($idAtelier);
        $entityManager = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $user = $this->getDoctrine()
        ->getRepository(User::class, 'default')
        ->find($id);
        
        if($convoquer) {
            $user->addConsultation($consultation);
        }
        else {
            $user->removeConsultation($consultation);
        }
        $entityManager->persist($user);
        $entityManager->flush();

        // dd('id:', $id,'idAtelier:',$idAtelier,'user:',$user,'atelier:',$consultation);

        // $consultation  = $this->aR->find($idAtelier);
        // $jaugeAtelier = $this->aR->NbrPersConvoc($idAtelier);
        
        return $this->render('ateliers/detail.html.twig', [
            'ateliers'      => $consultation,
            'users'         => $this->users,
            'idAtelier'     => $idAtelier,
            'date'          => $consultation->getDate(),
            'jaugeAtelier'  => 1,
            'titre'         => 'Détail de l\'atelier '. $consultation->getDate(),
            'pages'     => $this->pagesRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="ateliers_new", methods={"GET","POST","DELETE"})
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
            
            return $this->redirectToRoute('ateliers_index');
        }

        return $this->render('ateliers/new.html.twig', [
            'atelier'   => $consultation,
            'form'      => $form->createView(),
            'idAtelier' =>$consultation->getId(),
            'titre'     => 'Création d\'un atelier '
        ]);
    }

    /**
     * @Route("/{idAtelier}", name="ateliers_show", methods={"GET"})
     * 
     * @ParamConverter("booking", options={"mapping": {"idAtelier" : "id"}})
     * 
     */
    public function show(?Consultation $consultation,$idAtelier): Response
    {
        if ($idAtelier) $consultation = $this->aR->findOneById($idAtelier);
        return $this->render('ateliers/show.html.twig', [
            'atelier'       => $consultation,
            'idAtelier'     => $consultation->getId(),
            'titre'         => 'Affichage de l\'atelier '. $consultation->getDate(),
        ]);
    }


    /**
     * @Route("/{idAtelier}/newEdit", name="ateliers_new_edit", methods={"GET","POST"})
     * 
     */
    public function newEdit(Request $request, $idAtelier): Response
    {
        $tab = $request->request->get('ateliers');
        $consultation = $this->aR->findOneById($idAtelier);
        $consultation->setJauge($tab['nbrpersonnes']);
        $consultation->setStart($tab['dateatelier']);
        dd($request->request->get('ateliers'),$tab['nbrpersonnes'],$tab['dateatelier']);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($consultation);
        $entityManager->flush();

    }

    /**
     * @Route("/{idAtelier}/edit", name="ateliers_edit", methods={"GET","POST"})
     * 
     * @ParamConverter("booking", options={"mapping": {"idAtelier" : "id"}})
     * 
     */
    public function origEdit(Request $request, ?Consultation $consultation, $idAtelier): Response
    {
        if ($idAtelier) $consultation = $this->aR->findOneById($idAtelier);
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');
        // if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {
            
        if ($form->isSubmitted() && ($form->isValid() || $this->isCsrfTokenValid('edit', $submittedToken))) {
            
            $this->getDoctrine()->getManager()->flush();
            
            if ($this->isCsrfTokenValid('edit', $submittedToken)) 
            {
                
                return $this->render('ateliers/detail.html.twig', [
                    'ateliers'      => $consultation,
                    'users'         => $this->users,
                    'idAtelier'     => $idAtelier,
                    'date'          => $consultation->getDate(),
                    'jaugeAtelier'  => 1,
                    'titre'         => 'Modification de l\'atelier '. $consultation->getDate(),
                ]);
            }
            else {
                return $this->redirectToRoute('ateliers_index',[
                    'titre'         => 'Modification de l\'atelier '. $consultation->getDate(),
                ]);
            }
        }

        return $this->render('ateliers/edit.html.twig', [
            'atelier'       => $consultation,
            'idAtelier'     => $consultation->getId(),
            'date'          => $consultation->getDate(),
            'form'          => $form->createView(),
            'titre'         => 'Modification de l\'atelier '. $consultation->getDate(),
        ]);
    }

    /**
     * @Route("/{idAtelier}", name="atelier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Consultation $consultation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consultation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($consultation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ateliers_index', [
            'titre'         => 'Suppression de l\'atelier '. $consultation->getDate(),
        ]);
    }
}
