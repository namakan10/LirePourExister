<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AuthorThemeEditorFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {


        $themes =  array(
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
        $authors = array( "Marion Achard",
            "Janet et Allan Ahlberg",
            "Ahmad Akbarpour",
            "Yahya Alavi Fard",
            "Sylvie Albou-Tabart",
            "Lloyd Alexander",
            "Pauline Alphen",
            "Marie Amaury",
            "Hans Christian Andersen",
            "Jacques Asklund",
            "Sophie Audouin-Mamikonian",
            "Cécile Aubry",
            "Florence Aubry",
            "Gnimdéwa Atakpama",
            "Sigrid Baffert",
            "Bruce Balan",
            "Sophie Balazard",
            "Blue Balliett",
            "Philippe Barbeau",
            "Jill Barklem",
            "Loïc Barrière",
            "Georges Bayard",
            "Glecia Bear",
            "Alain Beaulieu",
            "Kidi Bebey",
            "Robert Belfiore",
            "John Bella",
            "Bettina Belitz",
            "Lucie Bergeron",
            "Paul Berna",
            "Heliane Bernard",
            "Sophie Bérubé",
            "Henriette Bichonnier",
            "Robert Bigot",
            "Quentin Blake",
            "Judy Blume",
            "Enid Blyton",
            "Douglas Brosset",
            "Éric Boisset",
            "Kevin Bokeili",
            "Paul-Jacques Bonzon",
            "Pierre Bottero",
            "Corinne Bouchard",
            "Claude Boujon",
            "Danièle Bour",
            "Patricia Bourque",
            "Ann Brashares",
            "Herbie Brennan",
            "Lisa Bresner",
            "Françoiz Breut, illustratrice",
            "Joyce Lankester Brisley",
            "Évelyne Brisou-Pellen",
            "Lysette Brochu",
            "Lauren Brooke",
            "Anthony Browne",
            "Gilles Brulet",
            "Jean de Brunhoff",
            "Melvin Burgess",
            "Frances Hodgson Burnett",
            "Marc Cantin",
            "Cathy Cassidy",
            "Meg Cabot",
            "Calouan",
            "Maurice Carême",
            "Zulma Carraud",
            "Jean-François Chabas",
            "Joelle Charbonneau",
            "Georges Chaulet",
            "Les Chats Pelés",
            "Sophie Chérer",
            "Alain Chiche",
            "Jean Claverie",
            "Gaston Clerc",
            "Brock Cole",
            "Eoin Colfer",
            "Fabrice Colin",
            "Vladimir Colin",
            "Suzanne Collins",
            "Carlo Collodi",
            "Marie Colmont",
            "Ally Condie",
            "Didier Convard",
            "Barbara Cooney (en)",
            "Brigitte Coppin",
            "Pierre Coran",
            "Philippe Corentin",
            "Pierre Cornuel",
            "Nadia Coste",
            "Joy Cowley",
            "Roald Dahl",
            "Valérie Dayre",
            "Jeanne-A Debats",
            "Martine Delerm",
            "Agnès Desarthe",
            "India Desjardins",
            "Robert Desnos",
            "Marie Desplechin",
            "Bernadette Després, illustratrice",
            "Alpha Mandé Diarra"
        );
        $editors = array(
            "Maison d’édition Gallimard",
            "Les Éditions Flammarion",
            "Les éditions Milan",
            "Les éditions Baudelaire",
            "Les éditions de Minuit",
            "Hachette",
            "Maison d’édition Le léopard masqué",
            "Maison d’éditon Privat",
            "Les éditions Julliard",
            "Les éditions Allary",
            "Balani's",
            "Cauris Éditions",
            "ÉDIM (Éditions Imprimeries du Mali)",
            "Éditions Donniya",
            "Éditions Fayida",
            "Éditions Jamana",
            "Éditions La Sahélienne",
            "Éditions Teriya",
            "Le Figuier",
            "Taama Éditions",
            "Bloomsbury Publishing",
            "Cambridge University Press",
            "Chapman & Hall",
            "Dorling Kindersley",
            "Minerva Press",
            "National Geographic",
            "Dunod"
        );



        $faker = Factory::create('fr_FR');

        /*
         * Themes
         */
        foreach ($themes as $th){
            $theme =  new Theme();
            $theme->setName($th);
            $manager->persist($theme);
        }

        /*
         * Auhors
         */
        for($i = 0; $i<50; $i++) {
            $author = new Author();
            $author->setName($faker->unique()->randomElement($array = $authors))
                ->setBiography($faker->text);
            $manager->persist($author);
        }


        /*
         * Editors
         */
        foreach ($editors as $edit){
            $editor = new Editor();
            $editor->setName($edit)
                ->setDescription($faker->text);
            $manager->persist($editor);
        }



        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
