<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $nbEntreprise = 3;
        for($i = 1; $i <= $nbEntreprise; $i++)
        {
            $Entreprise = new Entreprise();
            $Entreprise->setNom($faker->company);
            $Entreprise->setAdresse($faker->streetAddress);
            $Entreprise->setActivite($faker->realText($maxNbChars = 50, $indexSize = 2));
            $Entreprise->setSiteweb($faker->domainName);
            $manager->persist($Entreprise); 
        }
        
        $nbFormation = 4;
        for($i = 1; $i <= $nbFormation; $i++)
        {
            $Formation = new Formation();
            $Formation->setNomCourt($faker->realText($maxNbChars = 10, $indexSize = 2));
            $Formation->setNomLong($faker->realText($maxNbChars = 100, $indexSize = 2));
            $manager->persist($Formation); 
        }

        $nbFormation = 6;
        for($i = 1; $i <= $nbFormation; $i++)
        {
            $Stages = new Stage();
            $Stages->setTitre($faker->realText($maxNbChars = 10, $indexSize = 2));
            $Stages->setMission($faker->realText($maxNbChars = 200, $indexSize = 2));
            $Stages->setEmail($faker->email);

            $Stages->setTypeEntreprise($Entreprise);

            $Stages->addTypeFormation($Formation);

            $Entreprise->addStage($Stages);

            $Formation->addStage($Stages);

            $manager->persist($Stages); 
        }
        $manager->flush();
    }
}
