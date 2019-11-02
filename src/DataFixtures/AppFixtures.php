<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $category =  array(
          "Animaux",
          "Architecture",
          "Arts",
          "Art Dramatique",
          "Art du Spectacle",
          "Bandes Dessinées",
          "Biographie & Autobiographie",
          "Cuisine",
          "Développement Personnel",
          "Droit",
          "Economie & Affaires",
          "Education & Formation",
          "Etude littéraires",
          "Famille & Relations",
          "Fiction",
          "Géographie",
          "Histoire",
          "Adapté d'une Histoire Vraie",
          "Humour",
          "Informatique & Internet",
          "Jardinage",
          "Jeunesse",
          "Jeux",
          "Langues & Linguistique",
          "Livres de Référence",
          "Loisirs",
          "Maison & Travaux",
          "Mathématiques",
          "Médecine",
          "Musique",
          "Nature",
          "Objets Anciens & Collection",
          "Philosophie",
          "Photographie",
          "Poésie",
          "Psycologie & Psychiatrie",
          "Religion",
          "Santé & Fitness",
          "Sciences",
          "Sciences Politiques",
          "Sciences Sociales",
          "Soutien Aux Etudes",
          "Spiritualité",
          "Sports",
          "Technologie",
          "Transports",
          "Voyages"
        );

        foreach ($category as $ct){
            $cate =  new Category();
            $cate->setName($ct);
            $manager->persist($cate);
        }
        $manager->flush();
    }
}
