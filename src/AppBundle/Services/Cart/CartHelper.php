<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/06/18
 * Time: 21:33
 */

namespace AppBundle\Services\Cart;

use Symfony\Component\HttpFoundation\Session\Session;

class CartHelper
{
    /**
     * @var string
     */
    private static $key = 'cart';

    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getCart()
    {
        return $this->session->has(self::$key) ? $this->session->get(self::$key) : new Cart();
    }

    public function saveCart(Cart $cart)
    {
        $this->session->set(self::$key, $cart);
    }

    public function addItem(ProductInterface $product)
    {
        $cart = $this->getCart();

        $cartItem = CartItemBuilder::build($product, 1);

        $cart->addItem($cartItem);

        $this->saveCart($cart);
    }

    public function update(ProductInterface $product, $quantity)
    {
        $cart = $this->getCart();

        $cartItem = CartItemBuilder::build($product, $quantity);

        $cart->updateItem($cartItem);

        $this->saveCart($cart);
    }

    public function removeItem(ProductInterface $product)
    {
        $cart = $this->getCart();

        $cartItem = CartItemBuilder::build($product);

        $cart->removeItem($cartItem);
    }
}