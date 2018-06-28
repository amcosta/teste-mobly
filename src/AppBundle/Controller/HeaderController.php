<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HeaderController extends Controller
{
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $cart = $this->get('app.cart.helper')->getCart();

        return $this->render('header.html.twig', [
            'categories' => $categories,
            'cart' => $cart
        ]);
    }
}
