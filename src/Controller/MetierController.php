<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Repository\StageRepository;
use App\Repository\FormationRepository;
use App\Repository\EntrepriseRepository;

class MetierController extends AbstractController
{
    /**
     * @Route("/", name="metier_accueil")
     */
    public function index(StageRepository $repositoryStage): Response
    {
        $stages = $repositoryStage->findAll();

        // Envoyer les stages récupérés à la vue chargée de les afficher
        return $this->render('metier/index.html.twig', ['controller_name' => 'MetierController','stages'=>$stages]);
       
    }
      /**
     * @Route("/entreprises", name="metier_entreprises")
     */
    public function entreprises(EntrepriseRepository $repositoryEntreprise): Response
    {
        $entreprises = $repositoryEntreprise->findAll();

        return $this->render('metier/entreprises.html.twig', ['controller_name' => 'MetierController','entreprises'=>$entreprises]);
    }
      /**
     * @Route("/formation", name="metier_formation")
     */
    public function formation(FormationRepository $repositoryFormation): Response
    {
        $formations = $repositoryFormation->findAll();

        return $this->render('metier/formation.html.twig', ['controller_name' => 'MetierController','formations'=>$formations]);
    }
      /**
     * @Route("/stages/{id}", name="metier_stages_id")
     */
    public function stages(Stage $stage): Response
    {
        return $this->render('metier/stages.html.twig', ['controller_name' => 'MetierController',"stage"=>$stage]);

    } 
      /**
    * @Route("/entreprisesid/{id}", name="metier_entreprises_id")
    */
   public function entreprisesid(EntrepriseRepository $repositoryEntreprise,$id): Response
   {
       return $this->render('metier/entreprisesid.html.twig', ['controller_name' => 'MetierController','id'=>$id,]);

   }

      /**
    * @Route("/formationsid/{id}", name="metier_formations_id")
    */
    public function formationsid(FormationRepository $repositoryFormation,$id): Response
    {
        return $this->render('metier/formationsid.html.twig', ['controller_name' => 'MetierController','id'=>$id,]);
 
    }
}
