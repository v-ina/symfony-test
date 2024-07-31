<?php

//declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


// 여기 extends안하면 render 못씀
class ArticleController extends AbstractController
{

    #[Route('/articles', name: 'list_articles')]
    public function listArticles()
    {
        // 여기에서 배열로 전해줘야 현재 페이지의 변수를 twig에서 사용할 수 있음
//        return $this->render('page/list_articles.html.twig', [
//            'pokemons' => $pokemons
        $pokemons = [
            [
                'id' => 1,
                'title' => 'Carapuce',
                'content' => 'Pokemon eau',
                'isPublished' => false
            ],
            [
                'id' => 2,
                'title' => 'Salamèche',
                'content' => 'Pokemon feu',
                'isPublished' => false
            ],
            [
                'id' => 3,
                'title' => 'Bulbizarre',
                'content' => 'Pokemon plante',
                'isPublished' => false
            ],
            [
                'id' => 4,
                'title' => 'Pikachu',
                'content' => 'Pokemon electrique',
                'isPublished' => false
            ],
            [
                'id' => 5,
                'title' => 'Rattata',
                'content' => 'Pokemon normal',
                'isPublished' => true
            ],
            [
                'id' => 6,
                'title' => 'Roucool',
                'content' => 'Pokemon vol',
                'isPublished' => false
            ],
            [
                'id' => 7,
                'title' => 'Aspicot',
                'content' => 'Pokemon insecte',
                'isPublished' => false
            ],
            [
                'id' => 8,
                'title' => 'Nosferapti',
                'content' => 'Pokemon poison',
                'isPublished' => true
            ],
            [
                'id' => 9,
                'title' => 'Mewtwo',
                'content' => 'Pokemon psy',
                'isPublished' => true
            ],
            [
                'id' => 10,
                'title' => 'Ronflex',
                'content' => 'Pokemon normal',
                'isPublished' => false
            ]
        ];

            foreach ($pokemons as $pokemon) {
                $pokemonId = $pokemon['id'];
            }


        return $this->render('page/list_articles.html.twig', [
            'pokemons' => $pokemons
        ]);
    }

//    #[Route('/pokemon-sho/{id}', name: 'show_pokemon')]
//    public function showPokemon($id) : Response
//    {
//            $selectedPokemon = null;
//            foreach ($pokemons as $pokemon) {
//            if($pokemon['id'] == $idPokemon) {
//            $selectedPokemon = $pokemon;
//            }
//            }
//        return $this->render('page/pokemon_detail.html.twig', [
//            'pokemon' => $selectedPokemon
//        ]);

//    }
// pokemons 배열도 private과 생성자이용해서 모든 메소드에서 사용가능 할 수 있도록 함
// 밑에 대신 이렇게 위에처럼 사용가능
    #[Route('/pokemon-detail-article', name: 'show_pokemon')]
    public function showPokemon(Request $request){
//        이렇게 쓰면 $request= new Resquest ($_GET, etc)
//        $request = Request::createFromGlobals();  이거 안써도 됨

        // 이거 덕분에 get,post,update,delete 등의 http를 사용할 수 있는 거임
//        $request = Request::createFromGlobals();
        $idPokemon = $request->query->get('id');

        $pokemons = [
            [
                'id' => 1,
                'title' => 'Carapuce',
                'content' => 'Pokemon eau',
                'isPublished' => false
            ],
            [
                'id' => 2,
                'title' => 'Salamèche',
                'content' => 'Pokemon feu',
                'isPublished' => false
            ],
            [
                'id' => 3,
                'title' => 'Bulbizarre',
                'content' => 'Pokemon plante',
                'isPublished' => false
            ],
            [
                'id' => 4,
                'title' => 'Pikachu',
                'content' => 'Pokemon electrique',
                'isPublished' => false
            ],
            [
                'id' => 5,
                'title' => 'Rattata',
                'content' => 'Pokemon normal',
                'isPublished' => true
            ],
            [
                'id' => 6,
                'title' => 'Roucool',
                'content' => 'Pokemon vol',
                'isPublished' => false
            ],
            [
                'id' => 7,
                'title' => 'Aspicot',
                'content' => 'Pokemon insecte',
                'isPublished' => false
            ],
            [
                'id' => 8,
                'title' => 'Nosferapti',
                'content' => 'Pokemon poison',
                'isPublished' => true
            ],
            [
                'id' => 9,
                'title' => 'Mewtwo',
                'content' => 'Pokemon psy',
                'isPublished' => true
            ],
            [
                'id' => 10,
                'title' => 'Ronflex',
                'content' => 'Pokemon normal',
                'isPublished' => false
            ]
        ];


        $selectedPokemon = null;
        foreach ($pokemons as $pokemon) {
            if($pokemon['id'] == $idPokemon) {
                $selectedPokemon = $pokemon;
            }
        }


        return $this->render('page/pokemon_detail.html.twig', [
            'pokemon' => $selectedPokemon
        ]);

    }

}