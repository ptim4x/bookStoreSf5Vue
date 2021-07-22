<?php

namespace App\DataFixtures;

use App\DBAL\Types\ProductTypeEnumType;
use App\Entity\Genre;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        /*
        * Génère et persist les genres de livre
        */
        $genre_names=["Calligramme","Chanson","Chant royal","Élégie","Épigramme","Épopée","Fable","Fatrasie","Ghazel","Haïku","Hyangga","Kyōshi","Lai","Madrigal","Miscellanées","Motet","Nouvelle","Ode","Pastourelle","Poème autobiographique","Poésie en prose","Poésie pastorale","Poésie philosophique","Poème de cinq lignes","Oaristys","Rondeau","Rondel","Triolet","Sestina","Sextine","Serventois","Sirvente","Sonnet","Villanelle","Virel","Roman","Roman courtois","Roman historique","Roman épistolaire","Roman-mémoires","Roman d'amour","Roman industriel","Novella","Nouvelle fiction","Non-fiction","True crime","Roman d'aventures","Roman noir","Roman policier","Roman d'espionnage","Mondes perdus","Science-fiction","Anticipation","Cyberpunk","Steampunk","Space Opera","Science-fiction humoristique","Fantasy","Light fantasy","High fantasy","Fantastique","Horreur","Biographie","Autobiographie","Autofiction","Journal intime","Mémoires","Confessions","Conte","Épopée","Chanson de geste","Nouvelle","Roman en portraits","Nanolittérature","Micronouvelle","Twittérature","Fragment","Témoignage","Entretien","Reportage",];
        $max_genre=count($genre_names)-1;
        $genres=[];
        for($i = 0; $i <= $max_genre; $i++) {
            $genre = new Genre();
            $genre->setName($genre_names[$i]);
            $manager->persist($genre);
            $genres[$i]=$genre;
        }


        /*
        * Génère et persist les produits
        */
        $maxProduct=77;
        for($p = 0; $p < $maxProduct; $p++) {

            $product_type_rand = array_rand(array_flip(ProductTypeEnumType::getValues()));

            $product = new Product();
            $product->setTitle($faker->title)
            ->setCountry($faker->countryISOAlpha3)
            ->setOriginalTitle($faker->title)
            ->setDescription($faker->paragraph)
            ->setRanking(mt_rand(1,10))
            ->setPrice($faker->randomFloat(2, 7, 177))
            ->setProductType($product_type_rand);

            /*
             * Ajoute un ou des genres au produit courant de façon aléatoire
            */
            $genre_ids_rand=[];
            // nombre aléatoire de genre (<=5) par produit
            for($g = 0; $g < mt_rand(1, 5); $g++){
                // selectionne un id de genre aléatoirement
                $genre_ids_rand[] = mt_rand(0, $max_genre);
            }
            // dedoublonne les ids de genre le cas échéant
            $genre_ids_rand = array_unique($genre_ids_rand);
            // Ajoute au produit, les genres sélectionnés aléatoirement
            foreach($genre_ids_rand as $id_rand) {
                $product->addGenre($genres[$id_rand]);
            }

            $manager->persist($product);
        }

        $manager->flush();
    }
}
