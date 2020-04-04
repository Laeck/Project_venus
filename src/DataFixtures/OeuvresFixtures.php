<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Oeuvres;

class OeuvresFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++)
        {
            $oeuvre = new Oeuvres();
            $oeuvre->setNom("Nom sculpture n°$i")
                    ->setDescription("<p>Description de l'oeuvre n°$i")
                    ->setDateCreation(new \DateTime());
                    
            $manager->persist($oeuvre);
        }

        $manager->flush();
    }
}
