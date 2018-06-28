<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{
    /**
     * @Route(path="carrinho/adicionar-item/{id}", name="cart-add-item", methods={"GET"})
     *
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addItemAction(Product $product)
    {
        $this->get('app.cart.helper')->addItem($product);

        return $this->redirectToRoute('cart-index');
    }

    /**
     * @Route(path="carrinho/aumentar-quantidade/{id}", name="cart-increment-quantity")
     *
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function incrementItem(Product $product)
    {
        $this->get('app.cart.helper')->addItem($product);

        return $this->redirectToRoute('cart-index');
    }

    /**
     * @Route(path="carrinho", name="cart-index", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $this->get('app.cart.helper')->getCart()
        ]);
    }

}
