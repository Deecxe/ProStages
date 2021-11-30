<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetierController extends AbstractController
{
    /**
     * @Route("/", name="metier_accueil")
     */
    public function index(): Response
    {
        return $this->render('metier/index.html.twig', [
            'controller_name' => 'MetierController',
        ]);
    }
      /**
     * @Route("/entreprises", name="metier_entreprises")
     */
    public function entreprises(): Response
    {
        return $this->render('metier/entreprises.html.twig', [
            'controller_name' => 'MetierController',
        ]);
    }
      /**
     * @Route("/formation", name="metier_formation")
     */
    public function formation(): Response
    {
        return $this->render('metier/formation.html.twig', [
            'controller_name' => 'MetierController',
        ]);
    }
      /**
     * @Route("/stages/{id}", name="metier_stages_id")
     */
    public function stages($id): Response
    {
        return $this->render('metier/stages.html.twig', [
            'controller_name' => 'MetierController',
            'id'=>$id,
        ]);

    }
}
