<?php

namespace App\Controller;

use App\Entity\EnvoyePar;
use App\Form\EnvoyeParType;
use App\Repository\EnvoyeParRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/envoye/par")
 */
class EnvoyeParController extends AbstractController
{
    /**
     * @Route("/", name="envoye_par_index", methods={"GET"})
     */
    public function index(EnvoyeParRepository $envoyeParRepository): Response
    {
        return $this->render('envoye_par/index.html.twig', [
            'envoye_pars' => $envoyeParRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="envoye_par_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $envoyePar = new EnvoyePar();
        $form = $this->createForm(EnvoyeParType::class, $envoyePar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($envoyePar);
            $entityManager->flush();

            return $this->redirectToRoute('envoye_par_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('envoye_par/new.html.twig', [
            'envoye_par' => $envoyePar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="envoye_par_show", methods={"GET"})
     */
    public function show(EnvoyePar $envoyePar): Response
    {
        return $this->render('envoye_par/show.html.twig', [
            'envoye_par' => $envoyePar,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="envoye_par_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EnvoyePar $envoyePar): Response
    {
        $form = $this->createForm(EnvoyeParType::class, $envoyePar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('envoye_par_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('envoye_par/edit.html.twig', [
            'envoye_par' => $envoyePar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="envoye_par_delete", methods={"POST"})
     */
    public function delete(Request $request, EnvoyePar $envoyePar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$envoyePar->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($envoyePar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('envoye_par_index', [], Response::HTTP_SEE_OTHER);
    }
}
