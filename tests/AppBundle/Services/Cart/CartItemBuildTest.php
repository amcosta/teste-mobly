<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28/06/18
 * Time: 11:50
 */

namespace Tests\AppBundle\Services\Cart;

use AppBundle\Services\Cart\CartItem;
use AppBundle\Services\Cart\CartItemBuilder;
use AppBundle\Services\Cart\ProductInterface;
use PHPUnit\Framework\TestCase;

class CartItemBuildTest extends TestCase
{
    /**
     * @dataProvider providerBuildCartItem
     *
     * @param $product
     * @param $quantity
     * @param $quantityExpected
     */
    public function testBuildCart($product, $quantity, $quantityExpected)
    {
        $cartItem = CartItemBuilder::build($product, $quantity);

        $this->assertInstanceOf(CartItem::class, $cartItem);
        $this->assertEquals($quantityExpected, $cartItem->getQuantity());
    }

    public function providerBuildCartItem()
    {
        $product = $this->createMock(ProductInterface::class);

        return [
            [$product, 1, 1],
            [$product, 2, 2],
            [$product, 25, 25]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidQuantityThrowOfException()
    {
        $product = $this->createMock(ProductInterface::class);

        $cartItem = CartItemBuilder::build($product, 0);
    }
}