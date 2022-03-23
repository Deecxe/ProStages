<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $notRandom= new User();
        $notRandom->setPrenom("Not");
        $notRandom->setNom("Random");
        $notRandom->setUsername("NotRandom");
        $notRandom->setRoles(["ROLE_USER" , "ROLE_ADMIN"]);
        $notRandom->setPassword("$2y$10$/4xNizoP3gTiZq3UOK3xBuH/TZ0OVqGogiWn2hg14KKBU9qoUh9Ui");

        $manager->persist($notRandom);

        $random= new User();
        $random->setPrenom("Im");
        $random->setNom("Random");
        $random->setUsername("Random");
        $random->setRoles(["ROLE_USER"]);
        $random->setPassword("$2y$10$4yVdq93P4tuRNtWMcGBx/eYxVdmcaPLnfzmWumZBhvJpl5tSwAY86");

        $manager->persist($random);

        $faker = \Faker\Factory::create('fr_FR');

        $nbEntreprise = 3;
        for($i = 1; $i <= $nbEntreprise; $i++)
        {
            $Entreprise = new Entreprise();
            $Entreprise->setNom($faker->company);
            $Entreprise->setAdresse($faker->streetAddress);
            $Entreprise->setActivite($faker->realText($maxNbChars = 50, $indexSize = 2));
            $Entreprise->setSiteweb($faker->domainName);
            
            $tabEntreprise[] = $Entreprise;
            $manager->persist($Entreprise); 
        }


            $Formation = new Formation();
            $Formation->setNomCourt("DUT");
            $Formation->setNomLong("Diplôme Universitaire de Technologie");


            $Formation1 = new Formation();
            $Formation1->setNomCourt("DUT+");
            $Formation1->setNomLong("Diplôme Universitaire de Technologie un peu plus dur");

            $Formation2 = new Formation();
            $Formation2->setNomCourt("DUT++");
            $Formation2->setNomLong("Diplôme Universitaire de Technologie vachement plus dur");

            $TableauForm = array($Formation,$Formation1,$Formation2);

            foreach($TableauForm as $tab)
            {
            $manager->persist($tab);
            }

            $nbStages = 20;
            
            $tabStagiaireUtile = array('Golem','Stagiaire','Graphiste','Journaliste','Video gaming');
            $tabOutil = array('C++','HTML/CSS','PHP','Javascript','Reseaux','BD');

            for($i=0 ; $i <= $nbStages ; $i++)
            {
                $Num = $faker->numberBetween($min = 0, $max = 4);
                $Num2 = $faker->numberBetween($min = 0, $max = 5);
                $NumEntreprise = $faker->numberBetween($min = 0, $max = 2);
                $NumFormation = $faker->numberBetween($min = 0, $max = 2);

                $Stages = new Stage();
                $Stages->setTitre($tabStagiaireUtile[$Num]." en ".$tabOutil[$Num2]);
                $Stages->setMission($faker->realText($maxNbChars = 200, $indexSize = 2));
                $Stages->setEmail($faker->email);

                $Stages->setTypeEntreprise($tabEntreprise[$NumEntreprise]);
                $Stages->addTypeFormation($TableauForm[$NumFormation]);

                $manager->persist($Stages);
            }

            
            $manager->flush();
    }
}
