<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/06/18
 * Time: 19:00
 */

namespace AppBundle\Services\Cart;

interface ProductInterface
{
    public function getId();
    public function getName();
    public function getSlug();
    public function getPrice();
}