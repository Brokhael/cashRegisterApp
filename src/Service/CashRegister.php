<?php

namespace App\Service;

use App\Entity\Product;

class CashRegister
{
    private PricingRules $pricingRules;
    private array $cart;

    public function __construct(PricingRules $pricingRules)
    {
        $this->pricingRules = $pricingRules;
        $this->cart = [];
    }

    public function scanProduct(Product $product, int $quantity = 1): void
    {
        $this->cart[$product->getCode()] ??= ['product' => $product, 'quantity' => 0];
        $this->cart[$product->getCode()]['quantity'] += $quantity;
    }

    public function getTotal(): float
    {
        return array_reduce($this->cart, function ($total, $item) {
            return $total + $this->pricingRules->applyRules($item['product'], $item['quantity']);
        }, 0);
    }

}
