<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;

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
            $Entreprise->setActivite($faker->realText($maxNbChars = 200, $indexSize = 2));
            $Entreprise->setSiteweb($faker->domainName);
            $manager->persist($Entreprise); 
        }
        
        $manager->flush();
    }
}
