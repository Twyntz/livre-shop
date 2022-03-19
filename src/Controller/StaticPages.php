<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticPages extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $titre = 'Bienvenu sur Bookmania';

        return $this->render('home.html.twig', [
            'titre' => $titre
        ]);
    }
}