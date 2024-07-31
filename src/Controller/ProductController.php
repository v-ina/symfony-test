<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController{

    private $products;

    public function __construct(){
        $this->products = [
            [
                'id' => 1,
                'title' => 'Playstation 5',
                'price' => 499.99,
                'price_reduction' => 0,
                'image' => 'https://www.playstation.com/cdn-cgi/image/fit=cover,width=1920,height=1080,format=auto,quality=95/pscom-image/pscom-image/ps5/ps5-buy-now-light-background-image-block_tcm245-366802.jpg',
                'categories' => ['console', 'sony']
            ],
            [
                'id' => 2,
                'title' => 'Xbox Series X',
                'price' => 499.99,
                'price_reduction' => 0,
                'image' => 'https://compass-ssl.xbox.com/assets/0d/0f/0d0f1b1b-0b1b-4b1b-8b1b-1b1b0d0f1b0d.jpg?n=Xbox_Series_X-Page-Hero-1084_1924_02.jpg',
                'categories' => ['console', 'microsoft']
            ],
            [
                'id' => 3,
                'title' => 'Nintendo Switch',
                'price' => 299.99,
                'price_reduction' => 0,
                'image' => 'https://www.nintendo.com/content/dam/noa/en_US/hardware/switch/nintendo-switch-new-package/gallery/01-nintendo-switch-new-package.png',
                'categories' => ['console', 'nintendo']
            ],
            [
                'id' => 4,
                'title' => 'Playstation 4',
                'price' => 299.99,
                'price_reduction' => 199.99,
                'image' => 'https://www.playstation.com/cdn-cgi/image/fit=cover,width=1920,height=1080,format=auto,quality=95/pscom-image/pscom-image/ps4/ps4-buy-now-light-background-image-block_tcm245-366803.jpg',
                'categories' => ['console', 'sony']
            ],
            [
                'id' => 5,
                'title' => 'Xbox One',
                'price' => 299.99,
                'price_reduction' => 199.99,
                'image' => 'https://compass-ssl.xbox.com/assets/0d/0f/0d0f1b1b-0b1b-4b1b-8b1b-1b1b0d0f1b0d.jpg?n=Xbox_Series_X-Page-Hero-1084_1924_02.jpg',
                'categories' => ['console', 'microsoft']
            ],
        ];
    }

    #[Route('/products-list', name:'products_list')]
    public function findAllProducts(){
        $products = $this->products;
//        dump($products);
        return $this->render('page/productslist.html.twig', [
           'products' => $products,
        ]);
    }

//    err1. 여기에 $productid로 씀
    #[Route('product-detail/{productid}', name: 'product_detail')]
    public function findProductById(int $productid): Response
//                                                err2. 여기에 Resquest씀
    {
        $products = $this->products;
        $selectedProduct=null;

        foreach($products as $product){
            if($product['id'] === $productid){
                $selectedProduct=$product;
                break;
            }
        }

        return $this->render('page/productdetail.html.twig', [
            'product' => $selectedProduct,
        ]);

    }

}