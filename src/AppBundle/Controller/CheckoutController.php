<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CheckoutController extends Controller
{
    /**
     * @Route(path="checkout", name="checkout-index", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $cart = $this->get('app.cart.helper')->getCart();
        $user = $this->getUser();

        return $this->render('checkout/index.html.twig', [
            'cart' => $cart,
            'user' => $user
        ]);
    }
}
