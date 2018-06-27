<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/06/18
 * Time: 22:56
 */

namespace Tests\AppBundle\Services\Cart;

use AppBundle\Services\Cart\Cart;
use AppBundle\Services\Cart\CartItem;
use AppBundle\Services\Cart\ProductInterface;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /**
     * @return Cart
     */
    private function buildCart()
    {
        $items = [
            ['id' => 1, 'name' => 'Item 1', 'slug' => 'item-1', 'price' => 2, 'quantity' => 3],
            ['id' => 2, 'name' => 'Item 2', 'slug' => 'item-2', 'price' => 2, 'quantity' => 3],
            ['id' => 3, 'name' => 'Item 3', 'slug' => 'item-3', 'price' => 2, 'quantity' => 3],
        ];

        $cart = new Cart();

        foreach ($items as $item) {
            $cartItem = $this->buildItems($item['id'], $item['name'],$item['slug'], $item['price'], $item['quantity']);
            $cart->addItem($cartItem);
        }

        return $cart;
    }

    private function buildItems($id, $name, $slug, $price, $quantity)
    {
        $product = $this->createMock(ProductInterface::class);
        $product->method('getId')->willReturn($id);
        $product->method('getName')->willReturn($name);
        $product->method('getSlug')->willReturn($slug);
        $product->method('getPrice')->willReturn($price);

        $cartItem = new CartItem();
        $cartItem->setQuantity($quantity);
        $cartItem->setProduct($product);

        return $cartItem;
    }

    public function testFunctionAddItems()
    {
        $cart = $this->buildCart();

        $this->assertEquals(3, $cart->count());
        $this->assertEquals(18, $cart->calculateTotal());

        $cartItem = $this->buildItems(3,'Item 3', 'item-3', 2, 1);
        $cart->addItem($cartItem);

        $this->assertEquals(3, $cart->count());
        $this->assertEquals(20, $cart->calculateTotal());
    }

    public function testFunctionRemoveItem()
    {
        $cart = $this->buildCart();

        $cartItem = $this->buildItems(1, 'Item 1', 'item-1', 2, 3);
        $cart->removeItem($cartItem);

        $this->assertEquals(2, $cart->count());
        $this->assertEquals(12, $cart->calculateTotal());
    }

    public function testFunctionClearCart()
    {
        $cart = $this->buildCart();

        $cart->clearCart();

        $this->assertEquals(0, $cart->count());
        $this->assertEquals(0, $cart->calculateTotal());
    }

    public function testFunctionUpdateItem()
    {
        $cart = $this->buildCart();

        $cartItem = $this->buildItems(1, 'Item 1', 'item-1', 10, 2);
        $cart->updateItem($cartItem);

        $this->assertEquals(3, $cart->count());
        $this->assertEquals(32, $cart->calculateTotal());
    }
}