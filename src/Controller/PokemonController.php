<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PokemonController extends AbstractController{


    #[Route('/pokemons-list', name: 'pokemon_list')]
    public function findAllPokemons(Request $request, PokemonRepository $pokemonRepository) {
        $pokemons = $pokemonRepository->findAll();
        return $this->render('page/pokemon_list.html.twig', [
            'pokemons'=> $pokemons
        ]);
    }



    #[Route('/pokemon-detail/{id}', name: 'show_pokemon')]
    public function findByPk(int $id, PokemonRepository $pokemonRepository) {
        $pokemon = $pokemonRepository->find($id);
        if(!$pokemon){
            return $this->render('page/404.html.twig');
        }
        return $this->render('page/pokemon_detail.html.twig', [
            'pokemon' => $pokemon
        ]);
    }



    #[Route('/pokemons/search/title', name: 'pokemon_search')]
    public function searchPokemon(Request $request, PokemonRepository $pokemonRepository) : Response
    {
        $pokemonFound = null;
        if($request->request->has('title')){
//        if($request->isMethod('POST')){
            $titleSearched = $request->request->get('title');
//            $pokemonFound = $pokemonRepository->findOneBy(['title' => $titleSearched]);
            $pokemonFound = $pokemonRepository->findLikeTitle($titleSearched);

            if(!$pokemonFound) {
                $html = $this->renderView('page/404.html.twig');
                return new Response($html, 404);
            }
        }
        return $this->render('page/pokemon_search.html.twig', [
            'pokemons' => $pokemonFound
        ]);
    }



    #[Route('/pokemons/delete/{id}', name: 'pokemon_delete')]
    public function deletePokemon(int $id, PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager) : Response{
//      여기 파라미터로 $id를 연결해줘야 url의 id를 사용하는 거인듯
//      symfony에서는 update와 delete로는 리포지토리(PokemonRepository $pokemonRepository)가 아니라 다른 클래스(EntityManagerInterface $entityManager)를 사용한다.
//      PokemonRepository $pokemonRepository이거는 findbyPK를 위해서 필요함

//      dd('test'); = dump and die => 루트 잘 작동하나 처음에 테스트
        $pokemon = $pokemonRepository->find($id);
        $entityManager->remove($pokemon);
        $entityManager->flush();
        return $this->redirectToRoute('pokemon_list');
    }



    #[Route('/pokemons/insert', name:'insert_pokemon')]
    public function insertPokemon(Request $request, EntityManagerInterface $entityManager) : Response{

//      새로운 포켓몬 인스턴스 만들기 위해서는 Entity에 있는 pokemon에 추가해야함. constructor
//      $pokemon = new Pokemon(
//          title : "Salamèche",
//          description: "Sous le soleil, augmente l’Attaque Spéciale du Pokémon mais lui fait perdre 1/8 de ses PV à chaque tour.",
//          image : "https://www.gamosaurus.com/wp-content/uploads/2023/12/pokemon-violet-ecarlate-artwork-004.png.webp",
//          type : "feu"
//      );

        if($request->isMethod('POST')){
            $pokemon = new Pokemon(
                title: $request->request->get('title'),
                description: $request->request->get('description'),
                image: $request->request->get('image'),
                type: $request->request->get('type')
            );
            $entityManager->persist($pokemon);
            $entityManager->flush();
            return $this->redirectToRoute('pokemon_list');
        }
        return $this->render('page/add_pokemon.html.twig', []);
    }



    #[Route('/pokemons/insert/form-builder', name: 'insert_pokemon_form_builder')]
    public function insertPokemonFormBuilder(Request $request, EntityManagerInterface $entityManager){
// pour utiliser les infor ecrits par utilisateur, on utilise Request,
// Pour la methode POST on utilise EntityManagerInterface

        $pokemon = new Pokemon();
// on instancie a nouveau Pokemon par le class Pokemon
        $pokemonForm = $this->createForm(PokemonType::class, $pokemon);
// par la methode createForm utilisant une forme de formulaire qui sont definis en PokemonType en class, on cree un variable pokemonForm.
// enfin pokemonForm est devenu une formulaire.
        $pokemonForm->handleRequest($request);
// aujoute une methode handleRequest en donnant variable request pour utiliser les infos ecrits par cette pokemonForm formuliare.
        
//        이떄 위에서 manuellement하게 만들어야 했던 create를 위해서 만들었던 Pokemon클래스의 __construct를 지우고
//        view에서 form(pokemonForm)를 이용하며, app>Form>pokemonType에 ->add('valider', SubmitType::class) 를 추가하고
//        submitType::class를 잘 import(use) 해야한다.

        if($pokemonForm->isSubmitted() && $pokemonForm->isValid()){
            // quand on clique le boutton Valid
            $entityManager->persist($pokemon);
            $entityManager->flush();
            // on prepare et envoie les infos a la base de donnee

            return $this->redirectToRoute('pokemon_list');
        }

        return $this->render('page/add_pokemon_formbuilder.html.twig', [
            'pokemonForm' => $pokemonForm->createView()
        ]);
    }



    #[Route('/pokemons/update/{id}', name: 'updtade_pokemon_form_builder')]
    public function updatePokemonFormBuilder(Request $request,PokemonRepository $pokemonRepository, EntityManagerInterface $entityManager, int $id){

        $pokemon = $pokemonRepository->find($id);
//        on peut changer que cette ligne, puis pour le methode find(), on a besoin
//        PokemonRepository en parametre
        $pokemonForm = $this->createForm(PokemonType::class, $pokemon);
        $pokemonForm->handleRequest($request);
        
        if($pokemonForm->isSubmitted() && $pokemonForm->isValid()){
            $entityManager->persist($pokemon);
            $entityManager->flush();
        }

        return $this->render('page/add_pokemon_formbuilder.html.twig', [
            'pokemonForm' => $pokemonForm->createView()
        ]);
    }
}
