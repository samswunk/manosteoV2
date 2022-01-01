<?php

namespace App\Controller;

use App\Controller\ConsultationRdvController;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("booking/")
 */
class ConsultationOsteoController extends AbstractController
{
    private $rdv;

    public function __construct(ConsultationRdvController $rdv,BookingRepository $bookingRepository)
    {
        $this->rdv = $rdv;
        $this->bookingRepository = $bookingRepository;
        $this->bookings = $bookingRepository->findBy(array(), array('start' => 'DESC'));
    }    

    /**
     * @Route("/", name="booking_index", methods={"GET","POST"})
     */
    public function index(): Response
    {
        return $this->render('booking/tabIndex.html.twig', [
            'bookings' => $this->bookings,
            'ateliers' => $this->bookings,
            'titre'     => 'Liste des ateliers',
        ]);
    }

    /**
     * @Route("calendrier", name="booking_index", methods={"GET","POST"})
     */
    public function calendrier(): Response
    {
        return $this->render('booking/calendar.html.twig', [
            'bookings' => $this->bookings,
            'ateliers' => $this->bookings,
            'titre'     => 'Calendrier des ateliers',
        ]);
    }

    /**
     * @Route("valid", name="booking_valid", methods={"GET"})
     */
    public function valid(): Response
    {
        $start = date("Y-m-d");
        return $this->render('booking/index.html.twig', [
            'bookings' => $this->bookingRepository->findEventsToValidate($start),
        ]);
    }

    /**
     * @Route("list", name="booking_list", methods={"GET"})
     */
    public function list(): Response
    {
        $start = date("Y-m-d");
        return $this->render('booking/index.html.twig', [
            'bookings' => $this->bookings,
        ]);
    }
    
    /**
     * CREATION d'un ATELIER par MODAL
     * 
     * @Route("new_rdv", name="rdv_new", methods={"GET","POST"})
     */
    public function new_rdv(Request $request): Response
    {
        // dd($request->request->all());   
        $booking = new Booking();
        $id = $request->request->get('booking')['id'];
        $start=$request->request->get('booking')['start'];
        $entityManager = $this->getDoctrine()->getManager();
        
        // si un id existe il s'agit d'une modification.
        if ($id) 
        {
            echo(" MODIFICATION DE L'ATELIER ".$id);
                $bookingRepository = $this->getDoctrine()
                    ->getRepository(Booking::class, 'default')
                    ->find($id);
                if ($bookingRepository) 
                {   $start = new \DateTime(date("Y-m-d H:i:s",strtotime(str_replace('/', '-', $request->request->get('booking')['start']))));
                    $end = new \DateTime(date("Y-m-d H:i:s",strtotime(str_replace('/', '-', $request->request->get('booking')['end']).":00")));
                    $bookingRepository->setStart($start);
                    $bookingRepository->setEnd($end);
                    $bookingRepository->setIsFree(true);
                    $bookingRepository->setIsConfirmed(false);
                    $entityManager->flush();
                    return $this->render('booking/calendar.html.twig', [
                        'bookings'  => $this->bookings,
                        'ateliers'  => $this->bookings,
                        'start'     => $start->format('Y-m-d'),
                        'titre'     => 'Calendrier des ateliers',
                    ]);                    
                }
        }
        echo(" CREATION D'UN ATELIER ".$id);
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted()) 
        {
            $booking->setIsFree(true);
            $booking->setIsConfirmed(false);
            $booking->setJauge(10);
            $entityManager->persist($booking);
            $start=$booking->getStart();
            $entityManager->flush();
                /**/
        }
        return $this->render('booking/calendar.html.twig', [
            'bookings'  => $this->bookings,
            'ateliers'  => $this->bookings,
            'start'     => $start->format('Y-m-d'),
            'titre'     => 'Calendrier des ateliers',
        ]);    
    }
    
    /**
     * @Route("new", name="booking_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        $start = $request->request->get('booking')['start'] ?? '';
        // dd($start);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

            return $this->redirectToRoute('booking_index', [
                'start'     => $start,
            ]);
        }

        return $this->render('booking/new.html.twig', [
            'booking'   => $booking,
            'form'      => $form->createView(),
            'start'     => $start,
        ]);
    }

    /**
     * @Route("{id}", name="booking_show", methods={"GET"})
     */
    public function show(Booking $booking): Response
    {
        return $this->render('booking/show.html.twig', [
            'booking' => $booking,
        ]);
    }

    /**
     * @Route("{id}/edit", name="booking_edit", methods={"GET","POST","DELETE"})
     */
    public function edit(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);
        $start = $request->request->get('booking')['start'] ?? '';
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();
            $rdv = $this->rdv;
            $start = $booking->getStart();
            $typeEnvoi = ($request->request->get('booking')["isConfirmed"]==1 ? 'confirm' : 'cancel');
            // dd($provenance, $request->request->get('provenance'));
            if ($request->request->get('provenance')=='bookingcalendrier')  
                {
                    return $this->render('booking/calendar.html.twig', [
                        'bookings'  => $this->bookings,
                        'ateliers'  => $this->bookings,
                        'start'     => $start->format('Y-m-d'),
                        'titre'     => 'Calendrier des ateliers',
                    ]);   
                }
            return $this->redirectToRoute('booking_list');
        }

        return $this->render('booking/edit.html.twig', [
            'booking'   => $booking,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}", name="booking_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($booking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('booking_list');
    }
}
