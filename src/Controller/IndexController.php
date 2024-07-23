<?php

// on créé un namespace. un chemin pour identifier la classe actuelle
namespace App\Controller;
// 클래스가 있는 chemin을 나타내는데, 클래스 만들면 항상 namespace지정해줘야함.
// 만약 src 디렉토리에 바로 있다면 namespace App; 이렇게 표시될 것
// 이거 덕분에 symfony가 여기가 클래스를 보관하고 있는 곳이구나' 이해하게 됨.

// on appelle le namespace des classes qu'on utilise pour que symfony fasse le require de classe
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
// 얘도 되네 use Symfony\Component\Routing\Attribute\Route;


class IndexController extends AbstractController
{

    // annotation : # 이부분으로 작성되는 곳. 실제로는 코드에 나타나지 않지만, 이 덕분에
    // symfony가 이를 이해 할 수 있다. permet de creer une route.
    // une nouvelle page sur notre appli quand l'url est apprlée ça execute automatiquement la methode definit sous la route
    #[Route('/', name: 'home')]

    public function index(){

    // TIP : var_dump보다 그냥 dump쓰는게 배열이랑 객체 확인하는데에 더 쉽다
        $test = [ '1', '2', '3' ];
//        dump($test); var_dump($test);

        return $this->render('index.html.twig');
    // $loader = new \Twig\Loader\FilesystemLoader('../template');
    // $twig = new \Twig\Environment($loader);   이렇게 두줄 쓰는대신에 위에 한 줄 쓰면 됨
    }


    #[Route('/price', name: 'home-price')]
    public function home(){
        $request = Request::createFromGlobals();
        $maxPrice = $request->query->get('maxPrice');

        dump($maxPrice);
        return $this->render('page/index.html.twig');
    }

}