<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\AuthorRepository;
use App\Repository\EditorRepository;
use App\Repository\ThemeRepository;
use Faker\Factory;

class BookFixtures extends Fixture
{

    private $authorRepository;
    private $editorRepository;
    private $themeRepository;

    public function __construct(AuthorRepository $authorRepository,
                                EditorRepository $editorRepository,
                                ThemeRepository $themeRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->themeRepository = $themeRepository;
        $this->editorRepository = $editorRepository;
    }

    public function load(ObjectManager $manager)
    {
        $bookTitle = array("Voyage au bout de la nuit",
            "Vie et opinions de Tristram Shandy, gentilhomme",
            "Une maison de poupée",
            "Ulysse",
            "Trilogie : Molloy, Malone meurt, L'Innommable",
            "Saison de la migration vers le nord",
            "Saga de Njáll le Brûlé",
            "Romancero gitano",
            "Récits divers",
            "Rāmāyana",
            "Pedro Páramo",
            "Othello ou le Maure de Venise",
            "Orgueil et Préjugés",
            "Œdipe roi",
            "Odyssée",
            "Nostromo",
            "Mrs Dalloway",
            "Moby Dick",
            "Middlemarch",
            "Mémoires d'Hadrien",
            "Médée",
            "Masnavî",
            "Mahâbhârata",
            "Madame Bovary",
            "Lolita",
            "Livre de Job",
            "Les Voyages de Gulliver",
            "Les Mille et Une Nuits",
            "Les Métamorphoses",
            "Les Hauts de Hurlevent",
            "Les Grandes Espérances",
            "Les Frères Karamazov",
            "Les Fils de la Médina",
            "Les Enfants de minuit",
            "Les Démons",
            "Les Contes de Canterbury",
            "Les Buddenbrook",
            "Les Aventures de Huckleberry Finn",
            "Les Âmes mortes",
            "Le Vieil Homme et la Mer",
            "Le Tambour",
            "Le Rouge et le Noir",
            "Le Roi Lear",
            "Le Procès",
            "Le Père Goriot",
            "Le monde s'effondre",
            "Le Livre de l'intranquillité",
            "Le Journal d'un fou",
            "Le Jardin des fruits",
            "Le Grondement de la montagne",
            "Le Dit du Genji",
            "Le Château",
            "Le Carnet d'or",
            "Le Bruit et la Fureur",
            "La storia",
            "La Reconnaissance de Shâkountalâ",
            "La Promenade au phare",
            "La Mort d'Ivan Ilitch",
            "La Montagne magique",
            "La Faim",
            "La Conscience de Zeno",
            "L'Idiot",
            "L'Homme sans qualités",
            "L'Étranger",
            "L'Éducation sentimentale",
            "L'Aveuglement",
            "L'Amour aux temps du choléra",
            "Jacques le Fataliste et son maître",
            "Iliade",
            "Homme invisible, pour qui chantes-tu ?",
            "Hamlet",
            "Guerre et Paix",
            "Gens indépendants",
            "Gargantua et Pantagruel",
            "Fifi Brindacier",
            "Fictions",
            "Feuilles d'herbe",
            "Faust",
            "Essais",
            "Épopée de Gilgamesh",
            "Énéide",
            "Don Quichotte",
            "Divine Comédie",
            "Diadorim (Grande Sertão: veredas)",
            "Décaméron",
            "Crime et Châtiment",
            "Contes",
            "Cent ans de solitude",
            "Berlin Alexanderplatz",
            "Beloved",
            "Anna Karénine",
            "Amants et Fils",
            "Alexis Zorba",
            "Absalon, Absalon !",
            "À la recherche du temps perdu",
            "1984",
            "Hands-On Machine Learning with Scikit-Learn and TensorFlow",
            "Introduction to Machine Learning with Python",
            "Basics for Linear Algebra for Machine Learning",
            "The element of statisitcs");
        $faker = Factory::create('fr_FR');

        for($i=0; $i<100; $i++){
            $fakeid = $faker->numberBetween($min = 1, $max=50);
            $fake2id = $faker->numberBetween($min = 1, $max = 27);
            $fake3id = $faker->numberBetween($min = 1, $max = 47);
            $array_authors = $this->authorRepository->find($fakeid);
            $array_editors = $this->editorRepository->find($fake2id);
            $array_theme = $this->themeRepository->find($fake3id);
            $book = new Book();
            $book->setTitle($faker->unique()->randomElement($array = $bookTitle))
                ->addAuthor($array_authors)
                ->addTheme($array_theme)
                ->setEditor($array_editors)
                ->setPublishedDt($faker->dateTime)
                ->setLanguage($faker->randomElement($array = array ("Français" , "Anglais", "Espagnol")))
                ->setNbreCopies($faker->numberBetween($min = 1, $max = 50))
                ->setImage($faker->file($sourceDir = "C:\Users\Guest\Downloads\Compressed\Img",
                    $targetDir = "C:/xampp/htdocs/LirePourExister/public/images/books_cover", false))
                ->setDescritpion($faker->text)
                ->setNbrePage($faker->numberBetween($min = 10, $max = 2000))
                ->setIsbnIssn($faker->isbn13)
                ->setAvailability($faker->randomElement($array = array ("En lecture" , "En lecture & prêt")));
            $manager->persist($book);
        }

        $manager->flush();
    }
}
