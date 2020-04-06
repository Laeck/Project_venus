<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Oeuvres;
use App\Entity\Categories;


class OeuvresFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');


        for($i = 1; $i <= 4; $i++) 
        {
            $categorie = new Categories();
            $categorie->setNom($faker->sentence())
                    ->setDescription($faker->paragraph())
                    ->setPageAccueil('false');


            $manager->persist($categorie);

            for($j = 1; $j<= 10; $j++)
            {
                $oeuvre = new Oeuvres();

                $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';

                $oeuvre->setNom($faker->sentence())
                        ->setDescription($content)
                        ->setDateCreation($faker->dateTimeBetween('-3 months'))
                        ->setCategories($categorie);
                        

                $manager->persist($oeuvre);
            }
        }


        $manager->flush();
    }
}
