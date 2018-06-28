<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{
    /**
     * @Route(path="carrinho/adicionar-item/{id}", name="cart-add-item", methods={"GET"}, requirements={"id": "\d+"})
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
     * @Route(
     *     path="carrinho/atualizar-quantidade/{id}/{quantity}",
     *     name="cart-update-quantity",
     *     requirements={"id": "\d+", "quantity": "\d+"},
     *     methods={"GET"}
     * )
     *
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateQuantity(Product $product, $quantity)
    {
        if ($quantity <= 0) {
            $this->get('app.cart.helper')->removeItem($product);
        } else {
            $this->get('app.cart.helper')->update($product, $quantity);
        }

        return $this->redirectToRoute('cart-index');
    }

    /**
     * @Route(path="carrinho/remover-item/{id}", methods={"GET"}, requirements={"id": "\d+"}, name="cart-remove-item")
     *
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeItem(Product $product)
    {
        $this->get('app.cart.helper')->removeItem($product);

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
