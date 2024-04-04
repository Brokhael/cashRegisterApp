<?php

namespace App\Service;

use App\Entity\Product;

class CashRegister
{
    private PricingRules $pricingRules;
    private Cart $cart;

    public function __construct(PricingRules $pricingRules, Cart $cart)
    {
        $this->pricingRules = $pricingRules;
        $this->cart = $cart;
    }

    public function scanProduct(Product $product, int $quantity = 1): void
    {
        $this->cart->addItem($product, $quantity);
    }

    public function getTotal(): float
    {
        return array_reduce($this->cart->getItems(), function ($total, $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            return $total + $this->pricingRules->applyRules($product, $quantity);
        }, 0);
    }

}
