<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker=Factory::create("fr_FR");
        $categories=[];
        $categorie=new Categorie();
        $categorie  ->setLibelle("Professionnel")
                    ->setDescription($faker->paragraph())
                    ->setImage("image/categorie/professionnel.jpg");
        $manager->persist($categorie);
        $categories[]=$categorie;
        $categorie=new Categorie();
        $categorie  ->setLibelle("Sport")
                    ->setDescription($faker->sentence(50))
                    ->setImage("image/categorie/sport.jpg");
        $manager->persist($categorie);
        $categories[]=$categorie;
        $categorie=new Categorie();
        $categorie  ->setLibelle("Privé")
                    ->setDescription($faker->sentence(50))
                    ->setImage("image/categorie/prive.jpg");
        $manager->persist($categorie);
        $categories[]=$categorie;



        $genres=["male","female"];
              

        for ($i=0; $i < 100; $i++) 
        {  
            $sexe=mt_rand(0,1);
            if ($sexe==0)
            {
                $type="men";
            }else 
            {
                $type="women";
            }

             $contact=new Contact();
             $contact->setNom($faker->lastName())
                ->setPrenom($faker->firstName($genres[$sexe]))
                ->setSexe($sexe)
                ->setRue($faker->streetAddress())
                ->setVille($faker->city())
                ->setCp($faker->numberBetween(75000,92000))
                ->setMail($faker->email())
                ->setCategorie($categories[mt_rand(0,2)])
                ->setAvatar("https://randomuser.me/api/portraits/".$type."/" .$i.".jpg"); 
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
