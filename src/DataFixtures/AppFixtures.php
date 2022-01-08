<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $Entreprise1 = new Entreprise();
        $Entreprise1->setNom("E1");
        $Entreprise1->setAdresse("34 rue de la République");
        $Entreprise1->setActivite("Developpeur d'interface");
        $Entreprise1->setSiteweb("elegantthemes.com");
        $manager->persist($Entreprise1);

        $Entreprise2 = new Entreprise();
        $Entreprise2->setNom("E2");
        $Entreprise2->setAdresse("83 avenue Voltaire");
        $Entreprise2->setActivite("Concepteur d'application");
        $Entreprise2->setSiteweb("dropbox.com");
        $manager->persist($Entreprise2);

        $Entreprise3 = new Entreprise();
        $Entreprise3->setNom("E3");
        $Entreprise3->setAdresse("22 rue des Dunes");
        $Entreprise3->setActivite("Designer");
        $Entreprise3->setSiteweb("kickstarter.com");
        $manager->persist($Entreprise3);

        $manager->flush();
    }
}
