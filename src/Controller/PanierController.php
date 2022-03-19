<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Panier;
use App\Repository\PanierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/panier")
 */
class PanierController extends AbstractController {
    /**
     * @Route("/", name="app_panier_index", methods={"GET"})
     */
    public function index(PanierRepository $panierRepository): Response
    {
        return $this->render('panier/index.html.twig', [
            'paniers' => $panierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add/{id}", name="app_panier_add_book", methods={"GET"})
     */
    public function addBook(Book $book, PanierRepository $panierRepository): Response {
        if ($this->getUser()) {
            $panier = new Panier();

            $panier->setAcheter(0);
            $panier->setQuantite(1);
            $panier->setProduit($book);
            $panier->setUser($this->getUser());

            $panierRepository->add($panier);
        }

        return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/delete", name="app_panier_delete", methods={"GET"})
     */
    public function delete( Panier $panier, PanierRepository $panierRepository): Response
    {
        $panierRepository->remove($panier);

        return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
    }
}