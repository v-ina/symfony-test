<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PokerController extends AbstractController
{
    #[Route('/poker', name: 'poker')]
    public function index(){
        $request = Request::createFromGlobals();

//        if($request->query->get('age')){
        if($request->query->has('age')){
            $age = $request->query->get('age');

            if($age >= 18 ){
                $message = 'vous etes majeur';
            } else {
                $message = 'vous etes mineur';
            }

        } else {
            // Je ne pense pas que ce serait une bonne idée de faire flexible
            // pour le type $age comme celui-dessous...?

            $age = false;
            $message = 'remplissez le formulaire';
        }
        return $this->render('/page/poker.html.twig', ['age' => $age, 'message' => $message]);

    }

}