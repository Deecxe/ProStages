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

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;

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
   public function entreprisesid(Entreprise $entreprise): Response
   {
       return $this->render('metier/entreprisesid.html.twig', ['controller_name' => 'MetierController','entreprise'=>$entreprise,]);

   }

      /**
    * @Route("/formationsid/{id}", name="metier_formations_id")
    */
    public function formationsid(Formation $formation): Response
    {
        return $this->render('metier/formationsid.html.twig', ['controller_name' => 'MetierController','formation'=>$formation,]);
 
    }

      /**
    * @Route("/ajoutEntreprise", name="metier_ajoutEntreprise")
    */
    public function ajoutEntreprise(Request $request, EntityManagerInterface $manager): Response
    {
        $entreprise = new Entreprise();

        $formulaireEntreprise= $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('adresse')
        ->add('activite')
        ->add('siteweb')
        
        ->getForm();

        $formulaireEntreprise->handleRequest($request);

        if( $formulaireEntreprise->isSubmitted()  && $formulaireEntreprise->isValid())
        {
            $manager->persist($entreprise);
            $manager->flush();

            return $this -> redirectToRoute('ajoutEntreprise');
        }

        $vueFormulaireEntreprise=$formulaireEntreprise->createView();


        return $this->render('metier/ajoutEntreprise.html.twig',['vueFormulaire'=> $vueFormulaireEntreprise,'action'=>"ajouter"]);
    }

       /**
    * @Route("/modifierEntreprise/{id}", name="metier_modifierEntreprise")
    */
    public function modifierEntreprise(Request $request, EntityManagerInterface $manager, Entreprise $entreprise): Response
    {
        $formulaireEntreprise= $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('adresse')
        ->add('activite')
        ->add('siteweb')
        ->getForm();

        $formulaireEntreprise->handleRequest($request);

        if( $formulaireEntreprise->isSubmitted())
        {
            $manager->persist($entreprise);
            $manager->flush();

            return $this -> redirectToRoute('entreprises');
        }
        $vueFormulaireEntreprise=$formulaireEntreprise->createView();


        return $this->render('metier/ajoutEntreprise.html.twig',['vueFormulaire'=> $vueFormulaireEntreprise,'action'=> "modifier"]);
    }
}