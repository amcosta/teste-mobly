<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/06/18
 * Time: 22:02
 */

namespace AppBundle\Services\Cart;

interface CartItemInterface
{
    public function getProduct();

    public function getQuantity();

    public function getName();

    public function getPrice();

    public function calculateTotal();
}