<?php

namespace App\Controller;

use App\Entity\Indisponibilite;
use App\Form\IndisponibiliteType;
use App\Repository\IndisponibiliteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/indisponibilite")
 */
class IndisponibiliteController extends AbstractController
{
    /**
     * @Route("/", name="indisponibilite_index", methods={"GET"})
     */
    public function index(IndisponibiliteRepository $indisponibiliteRepository): Response
    {
        return $this->render('indisponibilite/index.html.twig', [
            'indisponibilites' => $indisponibiliteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="indisponibilite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $indisponibilite = new Indisponibilite();
        $form = $this->createForm(IndisponibiliteType::class, $indisponibilite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($indisponibilite);
            $entityManager->flush();

            return $this->redirectToRoute('indisponibilite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('indisponibilite/new.html.twig', [
            'indisponibilite' => $indisponibilite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="indisponibilite_show", methods={"GET"})
     */
    public function show(Indisponibilite $indisponibilite): Response
    {
        return $this->render('indisponibilite/show.html.twig', [
            'indisponibilite' => $indisponibilite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="indisponibilite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Indisponibilite $indisponibilite): Response
    {
        $form = $this->createForm(IndisponibiliteType::class, $indisponibilite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('indisponibilite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('indisponibilite/edit.html.twig', [
            'indisponibilite' => $indisponibilite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="indisponibilite_delete", methods={"POST"})
     */
    public function delete(Request $request, Indisponibilite $indisponibilite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$indisponibilite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($indisponibilite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('indisponibilite_index', [], Response::HTTP_SEE_OTHER);
    }
}
