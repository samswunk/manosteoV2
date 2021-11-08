<?php

namespace App\Controller;

use App\Entity\Accouchement;
use App\Form\AccouchementType;
use App\Repository\AccouchementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accouchement")
 */
class AccouchementController extends AbstractController
{
    /**
     * @Route("/", name="accouchement_index", methods={"GET"})
     */
    public function index(AccouchementRepository $accouchementRepository): Response
    {
        return $this->render('accouchement/index.html.twig', [
            'accouchements' => $accouchementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="accouchement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accouchement = new Accouchement();
        $form = $this->createForm(AccouchementType::class, $accouchement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accouchement);
            $entityManager->flush();

            return $this->redirectToRoute('accouchement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accouchement/new.html.twig', [
            'accouchement' => $accouchement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accouchement_show", methods={"GET"})
     */
    public function show(Accouchement $accouchement): Response
    {
        return $this->render('accouchement/show.html.twig', [
            'accouchement' => $accouchement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="accouchement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accouchement $accouchement): Response
    {
        $form = $this->createForm(AccouchementType::class, $accouchement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accouchement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accouchement/edit.html.twig', [
            'accouchement' => $accouchement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accouchement_delete", methods={"POST"})
     */
    public function delete(Request $request, Accouchement $accouchement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accouchement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accouchement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accouchement_index', [], Response::HTTP_SEE_OTHER);
    }
}
