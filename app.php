<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Entity\Product;
use App\Service\CashRegister;
use App\Service\PricingRules;
use App\Service\Cart;

$pricingRules = new PricingRules();
$cart = new Cart();
$cashRegister = new CashRegister($pricingRules, $cart);

$products = [
    [
        'code'     => 'GR1',
        'name'     => 'Green Tea 🍵',
        'price'    => 3.11,
        'quantity' => 1,
    ],
    [
        'code'     => 'SR1',
        'name'     => 'Strawberry 🍓',
        'price'    => 5.00,
        'quantity' => 2,
    ],
    [
        'code'     => 'CF1',
        'name'     => 'Coffee ☕ ',
        'price'    => 11.23,
        'quantity' => 3,
    ],
//    Add more products here ...
//    [
//        'code'     => 'CC1',
//        'name'     => 'Pizza 🍕 ',
//        'price'    => 7.39,
//        'quantity' => 4,
//    ],
];

foreach ($products as $product) {
    $cashRegister->scanProduct(
        new Product(
            $product['code'],
            $product['name'],
            $product['price']
        ),
        $product['quantity']
    );
}

$items = $cart->getItems();
$total = $cashRegister->getTotal();

foreach ($items as $item) {
    echo ' x' . $item['quantity'] . ' ' . $item['product']->getName() . "\n";
}
echo "Total 💶: €$total  \n";