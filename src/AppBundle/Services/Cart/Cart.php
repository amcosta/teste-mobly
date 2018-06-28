<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/06/18
 * Time: 18:52
 */

namespace AppBundle\Services\Cart;

class Cart
{
    /**
     * @var array
     *
     * @Serializer\Type("AppBundle\Services\Cart\CartItem")
     */
    private $items = [];

    public function addItem(CartItem $cartItem)
    {
        $key = $this->searchItem($cartItem);

        if (false === $key) {
            array_push($this->items, $cartItem);
            return;
        }

        $cartItem = $this->items[$key];
        $cartItem->increment();

        $this->items[$key] = $cartItem;
    }

    public function removeItem(CartItem $cartItem)
    {
        $key = $this->searchItem($cartItem);

        if ($key >= 0) {
            unset($this->items[$key]);
        }
    }

    public function updateItem(CartItem $cartItem)
    {
        $key = $this->searchItem($cartItem);

        if (false !== $key) {
            $this->items[$key] = $cartItem;
        }
    }

    public function clearCart()
    {
        $this->items = [];
    }

    public function calculateTotal()
    {
        return array_reduce($this->items, function($total, CartItem $cartItem) {
            $total += $cartItem->calculateTotal();
            return $total;
        }, 0);
    }

    public function count()
    {
        return count($this->items);
    }

    private function searchItem(CartItem $cartItem)
    {
        /* @var CartItem $item */
        foreach ($this->items as $key => $item) {
            if ($item->getProductId() === $cartItem->getProductId()) {
                return $key;
            }
        }

        return false;
    }

    public function getItems()
    {
        return $this->items;
    }
}