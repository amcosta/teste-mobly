<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28/06/18
 * Time: 11:36
 */

namespace AppBundle\Services\Cart;

class CartItemBuilder
{
    static public function build(ProductInterface $product, $quantity = 1)
    {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException('The quantity must be greater than 0');
        }

        $cartItem = new CartItem();
        $cartItem->setProduct($product);
        $cartItem->setQuantity($quantity);

        return $cartItem;
    }
}