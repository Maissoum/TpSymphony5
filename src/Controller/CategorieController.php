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

    #[Route('/categories/nbContactsParCat', name: 'nbContactsParCat', methods:'GET' )]
    public function CalculNbContactsParCat(CategorieRepository $repo) 
    {
        $data="";
        $categorie=$repo->nbContactsParCat();
         return $this->render('categorie/nbContactsParCat.html.twig', [
            'lesCategories' => $categorie,
            'data' => $data
        ]);
    }
}
