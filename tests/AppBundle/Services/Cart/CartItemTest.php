<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/06/18
 * Time: 19:12
 */

namespace Tests\AppBundle\Services\Cart;

use AppBundle\Services\Cart\CartItem;
use AppBundle\Services\Cart\ProductInterface;
use PHPUnit\Framework\TestCase;

class CartItemTest extends TestCase
{
    public function testValidData()
    {
        $product = $this->createMock(ProductInterface::class);
        $product->method('getName')->willReturn('Item 1');
        $product->method('getPrice')->willReturn(10);

        $cartItem = new CartItem();

        $cartItem->setProduct($product);
        $cartItem->setQuantity('03');

        $this->assertEquals('Item 1', $cartItem->getProductName());
        $this->assertEquals(10, $cartItem->getProductPrice());
        $this->assertEquals(3, $cartItem->getQuantity());
        $this->assertEquals(30, $cartItem->calculateTotal());
    }

    public function testInvalidData()
    {
        $product = $this->createMock(ProductInterface::class);
        $product->method('getName')->willReturn('Item 1');
        $product->method('getPrice')->willReturn(10);

        $cartItem = new CartItem();

        $cartItem->setProduct($product);
        $cartItem->setQuantity('abc');

        $this->assertEquals('Item 1', $cartItem->getProductName());
        $this->assertEquals(10, $cartItem->getProductPrice());
        $this->assertEquals(0, $cartItem->calculateTotal());
    }
}