<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/06/18
 * Time: 18:58
 */

namespace AppBundle\Services\Cart;

class CartItem
{
    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = (int) $quantity;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->product->getName();
    }

    /**
     * @return float|integer
     */
    public function getProductPrice()
    {
        return $this->product->getPrice();
    }

    /**
     * @return string
     */
    public function getProductSlug()
    {
        return $this->product->getSlug();
    }

    /**
     * @return integer
     */
    public function getProductId()
    {
        return $this->product->getId();
    }

    /**
     * @return float|integer
     */
    public function calculateTotal()
    {
        $price = $this->getProductPrice();

        return $price * $this->quantity;
    }

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 0) {
            $this->quantity--;
        }
    }
}