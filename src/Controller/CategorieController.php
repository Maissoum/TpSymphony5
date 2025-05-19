<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categories', name: 'app_categories', methods:'GET' )]
    public function listeCategories(CategorieRepository $repo): Response 
    {
        $categorie=$repo->findAll();
        return $this->render('categorie/listeCategories.html.twig', [
            'lesCategories' => $categorie 
        ]);
    }

    #[Route('/categorie/{id}', name: 'app_ficheCategorie', methods:'GET' )]
    public function lafficheCategories(Categorie $categorie)
    {
        return $this->render('categorie/ficheCategorie.html.twig', [
            'laCategorie' => $categorie 
        ]);
    }

    #[Route('/nbContactsParCat', name: 'nbContactsParCat', methods:'GET' )]
    public function nbContactsParCat(CategorieRepository $repo) 
    {
        $data="";
        $categorie=$repo->nbContactsParCat();
        foreach($categorie as $ligne){
            $data .='{ y: '.$ligne["nbContacts"]. ',label: "'.$ligne["libelle"].'" },';
        }
        $data=substr($data,0,-1);
        
         return $this->render('categorie/nbContactsParCat.html.twig', [
            'lesCategories' => $categorie,
            'data' => $data
        ]);
    }
}
