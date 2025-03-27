<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker=Factory::create("fr_FR");
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
                ->setAvatar("https://randomuser.me/api/portraits/".$type.$i.".png");
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
