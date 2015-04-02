<?php

namespace Hautelook;

class Cart
{
    /**
     * @var Product[]
     */
    private $products = [];

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getSubtotal()
    {
        $subtotal = 0;
        foreach ($this->products as $product) {
            $subtotal += $product->getPrice();
        }

        return $subtotal;
    }
} 
