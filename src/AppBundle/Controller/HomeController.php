<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route(name="home", path="/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        shuffle($products);

        return $this->render('home/homepage.html.twig', [
            'products' => array_slice($products, 0, 4)
        ]);
    }
}
