<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;

class MetierController extends AbstractController
{
    /**
     * @Route("/", name="metier_accueil")
     */
    public function index(): Response
    {
        $repositoryRessource = $this->getDoctrine()->getRepository(Stage::class);

        $StagesTrouve = $repositoryRessource->findAll();

        return $this->render('metier/index.html.twig', ['controller_name' => 'MetierController','StagesTrouve'=>$StagesTrouve]);
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
      /**
    * @Route("/entreprisesid/{id}", name="metier_entreprises_id")
    */
   public function entreprisesid($id): Response
   {
       return $this->render('metier/entreprisesid.html.twig', [
           'controller_name' => 'MetierController',
           'id'=>$id,
       ]);

   }
}
