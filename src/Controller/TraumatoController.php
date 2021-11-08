<?php

namespace App\Controller;

use App\Entity\Traumato;
use App\Form\TraumatoType;
use App\Repository\TraumatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/traumato")
 */
class TraumatoController extends AbstractController
{
    /**
     * @Route("/", name="traumato_index", methods={"GET"})
     */
    public function index(TraumatoRepository $traumatoRepository): Response
    {
        return $this->render('traumato/index.html.twig', [
            'traumatos' => $traumatoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="traumato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $traumato = new Traumato();
        $form = $this->createForm(TraumatoType::class, $traumato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($traumato);
            $entityManager->flush();

            return $this->redirectToRoute('traumato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traumato/new.html.twig', [
            'traumato' => $traumato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="traumato_show", methods={"GET"})
     */
    public function show(Traumato $traumato): Response
    {
        return $this->render('traumato/show.html.twig', [
            'traumato' => $traumato,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="traumato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Traumato $traumato): Response
    {
        $form = $this->createForm(TraumatoType::class, $traumato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('traumato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traumato/edit.html.twig', [
            'traumato' => $traumato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="traumato_delete", methods={"POST"})
     */
    public function delete(Request $request, Traumato $traumato): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traumato->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($traumato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('traumato_index', [], Response::HTTP_SEE_OTHER);
    }
}
