<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PokemonCategory extends AbstractController

{
    #[Route('/pokemon-category', name: 'pokemon_category_list')]
    public function listArticles() {
        $categories = [
            'Red', 'Green', 'Blue', 'Yellow', 'Gold', 'Silver', 'Crystal'
        ];

//        return $this->render('page/pokemon_category_list.html.twig', [
//            'categories' => $categories
//        ]);

        $html = $this->renderView('page/pokemon_category_list.html.twig', [
            'categories' => $categories
        ]);


        return new Response($html, 200);
    }
}