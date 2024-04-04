<?php

namespace App\Service;

use App\Entity\Product;
class Cart
{
    private array $items = [];

    public function addItem(Product $product, int $quantity = 1): void
    {
        $this->items[$product->getCode()] ??= ['product' => $product, 'quantity' => 0];
        $this->items[$product->getCode()]['quantity'] += $quantity;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}