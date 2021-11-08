<?php

namespace App\Controller;

use App\Entity\Pediatrie;
use App\Form\PediatrieType;
use App\Repository\PediatrieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pediatrie")
 */
class PediatrieController extends AbstractController
{
    /**
     * @Route("/", name="pediatrie_index", methods={"GET"})
     */
    public function index(PediatrieRepository $pediatrieRepository): Response
    {
        return $this->render('pediatrie/index.html.twig', [
            'pediatries' => $pediatrieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pediatrie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pediatrie = new Pediatrie();
        $form = $this->createForm(PediatrieType::class, $pediatrie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pediatrie);
            $entityManager->flush();

            return $this->redirectToRoute('pediatrie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pediatrie/new.html.twig', [
            'pediatrie' => $pediatrie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pediatrie_show", methods={"GET"})
     */
    public function show(Pediatrie $pediatrie): Response
    {
        return $this->render('pediatrie/show.html.twig', [
            'pediatrie' => $pediatrie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pediatrie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pediatrie $pediatrie): Response
    {
        $form = $this->createForm(PediatrieType::class, $pediatrie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pediatrie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pediatrie/edit.html.twig', [
            'pediatrie' => $pediatrie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pediatrie_delete", methods={"POST"})
     */
    public function delete(Request $request, Pediatrie $pediatrie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pediatrie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pediatrie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pediatrie_index', [], Response::HTTP_SEE_OTHER);
    }
}
