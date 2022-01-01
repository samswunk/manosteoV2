<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RdvType;
use App\Entity\Consultation;
use App\Entity\Patient;
use App\Form\ConsultationType;
use App\Repository\ConsultationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/atelier")
*/
class ConsultationRdvController extends AbstractController
{
 
    private $security;
    private $mailer;

    public function __construct(Security $security, ConsultationRepository $consultationRepository)
    {
            $this->security = $security;
            $this->aR       = $consultationRepository;
    } 

    public function envoiMail($typeEnvoi, ?Consultation $consultation, ?Patient $user,$token=null,$url='')
    {
        switch($typeEnvoi)
        {
            case 'delete':
                $libEnvoi="annulation";
                $objEnvoi=strtoupper($libEnvoi)." de votre atelier boite à Cuisine";
            break;
            case 'edit':
                $libEnvoi="mail";
                $objEnvoi="Modification atelier boite à Cuisine";
            break;
            case 'create':
                $libEnvoi="mail";
                $objEnvoi="Demande d'atelier boite à Cuisine";
            break;
            case 'confirm':
                $libEnvoi="confirmation";
                $objEnvoi=strtoupper($libEnvoi)." de votre atelier boite à Cuisine";
            break;
            case 'cancel':
                $libEnvoi="avalidation";
                $objEnvoi="Annulation de l'atelier.";
            break;
            case 'reset':
                $libEnvoi="reset";
                $objEnvoi="Réinitialisation de mot de passe.";
                break;
        }
        $contact    = $user->getNom().' '.$user->getPrenom();
        
        $tabAdresse = $user->getAdresse();
        $adresse    = $tabAdresse->getAdresse1() .' '.$tabAdresse->getAdresse2() .' '. $tabAdresse->getCodePostal().' '.$tabAdresse->getVille();
        
        $tabCoordonnees = $user->getTelephone();
        $emailDest  = $tabCoordonnees->getMail();
        $telephone  = $tabCoordonnees->getTelephone();
        
        $start      = $consultation ? $consultation->getDate()->format('d/m/Y H:i') : '';
        // $msg = (new \Swift_Message($objEnvoi))
        //     // ->setFrom('contact@boiteacuisine.fr')
        //     ->setFrom('application@hotmail.fr')
        //     ->setTo($emailDest)
        //     ->setBody($this->renderView('mail/'.$libEnvoi.'.html.twig', [
        //                     'consultation'   => $consultation,
        //                     'contact'   => $contact,
        //                     // 'marque'    => $marque,
        //                     // 'tarif'     => $tarif,
        //                     'url'       => $url
        //                 ]),
        //                 'text/html'
        //                 );

        // $this->mailer->send($msg);

    }

    /**
     * @Route("/mes_ateliers/{id}", name="ateliers_profil", methods={"GET","POST"})
     */
    public function mesAteliers(User $id): Response
    {
        $bookings = $this->aR->findMesAteliers($id);
        return $this->render('rdv/mesrdv.html.twig', [
            'bookings'      => $bookings,
            'VarBookings'   => count($bookings),
            'pages'     => $this->pagesRepository->findAll()
            // ->findAll(),
        ]);
    }

    /**
    * @Route("/{id}/valider", name="ateliers_valider", methods={"GET","POST"})
    */
    public function Valider(Request $request, Consultation $booking): Response
    {
        
        $booking->setIsConfirmed(1);
        $this->getDoctrine()->getManager()->flush();
        $listEmail="";
        foreach ($booking->getPatient() as $key => $user) {
            dump($user->getEmail());
            $listEmail.=$user->getEmail().";";
        }
        // dd($listEmail, $booking->getIdUser());
        // $this->envoiMail('confirm',$booking,$request->getUser());
        $this->addFlash('message',"Le rdv est confirmé");
        return $this->redirectToRoute('booking_list',[
            'pages'     => $this->pagesRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}/mail", name="mail", methods={"GET","POST"})
    */
    public function mail(Consultation $booking): Response
    {
        return $this->render('mail/mail.html.twig', [
            'booking' => $booking,
            'pages'     => $this->pagesRepository->findAll()
        ]);
    }

    /**
     * 
     * @Route("/{idAtelier}/{idUser}/inscription", name="atelier_inscription", methods={"GET","POST"})
     */
    public function inscription(Consultation $idAtelier, Patient $idUser):Response
    {
        $idAtelier->setPatient($idUser);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($idAtelier);
        $entityManager->flush();
        return $this->render('booking/calendar.html.twig', [
            'bookings' => $this->aR->findBy(array(), array('start' => 'DESC')),
            'ateliers' => $this->aR->findBy(array(), array('start' => 'DESC')),
            'titre'     => 'Liste des ateliers',
            'pages'     => $this->pagesRepository->findAll()
            // ->findAll(),
        ]);
        // $user = $this->getDoctrine()
        // ->getRepository(User::class, 'default')
        // ->find($idUser);        
        // $atelier = $this->getDoctrine()
        // ->getRepository(User::class, 'default')
        // ->find($idUser);        
        // $entityManager = $this->getDoctrine()->getManager();
        
        // if($convoquer) {
        //     $user->addConsultation($atelier);
        // }
        // else {
        //     $user->removeConsultation($atelier);
        // }
    } 

    /**
     * Modification d'un atelier (pour un utilisateur, se positionner ou le modifier)
     * 
     * @Route("/{id}/edit", name="atelier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Consultation $booking): Response
    {
        // On cherche l'idUser du booking pour savoir s'il s'agit d'une création ou d'une modification 
        $IdUserPrec = $booking->getPatient()->getId();
        $form = $this->createForm(RdvType::class, $booking);
        // dd($booking,$request);
        $form->handleRequest($request);
        $view = $form->getViewData();

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $user = $this->getUser();
            $booking->setPatient($user);
            $booking->setIsFree(false);
            // dd($user);
            $this->envoiMail(($IdUserPrec?'edit':'create'),$booking,$user);
            
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('message',"un mail vient d'être envoyé");
            return $this->redirectToRoute('booking_index',[
                'pages'     => $this->pagesRepository->findAll()
            ]);
        }

        return $this->render('rdv/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
            'pages'     => $this->pagesRepository->findAll()
        ]);
    } 

    /**
     * @Route("/{id}", name="ateliers_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, Consultation $booking): Response
    {
        $vMethod=$request->getMethod();
        // dd($booking);
        if ($request->isMethod('POST')) 
        {
            $start = $booking->getDate(); // new \DateTime(date("Y-m-d H:i:s",strtotime(str_replace('/', '-', $booking->getStart()))));
            $start = $start->format('d/m/Y H:i');
            $this->envoiMail('delete', $booking, $request->getUser());
            $booking->setTitre('RDV '.$start);
            $booking->setMotif('');
            $booking->setIsFree(true);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('booking_index',[
                'pages'     => $this->pagesRepository->findAll()
            ]);
        }
        return $this->render('rdv/edit.html.twig', [
            'booking' => $booking,
            'pages'     => $this->pagesRepository->findAll()
        ]);
    }

   /*        $serializer = new Serializer([new ObjectNormalizer()]);
        $repos = $serializer->normalize($repos, null, [AbstractNormalizer::ATTRIBUTES => ['id','title','start','end','description','backgroundColor','IdUser' => ['id','Nom','telephone','email']]]);
        // $result = $serializer->normalize($level1, null, [AbstractObjectNormalizer::ENABLE_MAX_DEPTH => true]);
        $repos=str_replace(":00+00:00","",$repos);
        dd($vstart,$vend,$repos,$response);
        return $response;        
*/
}

?>