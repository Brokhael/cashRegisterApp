<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Product;
use App\Service\CashRegister;
use App\Service\PricingRules;
use App\Service\Cart;

class CashRegisterEndToEndTest extends TestCase
{
    public function testScenario1(): void
    {
        $products = [
            [
                'code'     => 'GR1',
                'name'     => 'Green Tea 🍵',
                'price'    => 3.11,
                'quantity' => 1,
            ],
            [
                'code'     => 'GR1',
                'name'     => 'Green Tea 🍵',
                'price'    => 3.11,
                'quantity' => 1,
            ],
        ];

        $pricingRules = new PricingRules();
        $cart = new Cart();
        $cashRegister = new CashRegister($pricingRules, $cart);

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

        $total = $cashRegister->getTotal();

        $this->assertSame(3.11, $total);
    }
    public function testScenario1b(): void
    {
        $products = [
            [
                'code'     => 'GR1',
                'name'     => 'Green Tea 🍵',
                'price'    => 3.11,
                'quantity' => 2,
            ],
        ];

        $pricingRules = new PricingRules();
        $cart = new Cart();
        $cashRegister = new CashRegister($pricingRules, $cart);

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

        $total = $cashRegister->getTotal();

        $this->assertSame(3.11, $total);
    }

    public function testScenario2(): void
    {
        $products = [
            [
                'code'     => 'SR1',
                'name'     => 'Strawberry 🍓',
                'price'    => 5.00,
                'quantity' => 1,
            ],
            [
                'code'     => 'SR1',
                'name'     => 'Strawberry 🍓',
                'price'    => 5.00,
                'quantity' => 1,
            ],
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
                'quantity' => 1,
            ],
        ];

        $pricingRules = new PricingRules();
        $cart = new Cart();
        $cashRegister = new CashRegister($pricingRules, $cart);

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

        $total = $cashRegister->getTotal();

        $this->assertSame(16.61, $total);
    }
    public function testScenario2b(): void
    {
        $products = [
            [
                'code'     => 'SR1',
                'name'     => 'Strawberry 🍓',
                'price'    => 5.00,
                'quantity' => 3,
            ],
            [
                'code'     => 'GR1',
                'name'     => 'Green Tea 🍵',
                'price'    => 3.11,
                'quantity' => 1,
            ],
        ];

        $pricingRules = new PricingRules();
        $cart = new Cart();
        $cashRegister = new CashRegister($pricingRules, $cart);

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

        $total = $cashRegister->getTotal();

        $this->assertSame(16.61, $total);
    }

    public function testScenario3(): void
    {
        $products = [
            [
                'code'     => 'GR1',
                'name'     => 'Green Tea 🍵',
                'price'    => 3.11,
                'quantity' => 1,
            ],
            [
                'code'     => 'CF1',
                'name'     => 'Coffee ☕',
                'price'    => 11.23,
                'quantity' => 1,
            ],
            [
                'code'     => 'SR1',
                'name'     => 'Strawberry 🍓',
                'price'    => 5.00,
                'quantity' => 1,
            ],
            [
                'code'     => 'CF1',
                'name'     => 'Coffee ☕',
                'price'    => 11.23,
                'quantity' => 1,
            ],
            [
                'code'     => 'CF1',
                'name'     => 'Coffee ☕',
                'price'    => 11.23,
                'quantity' => 1,
            ],
        ];

        $pricingRules = new PricingRules();
        $cart = new Cart();
        $cashRegister = new CashRegister($pricingRules, $cart);

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

        $total = $cashRegister->getTotal();

        $this->assertSame(30.57, $total);
    }
    public function testScenario3b(): void
    {
        $products = [
            [
                'code'     => 'GR1',
                'name'     => 'Green Tea 🍵',
                'price'    => 3.11,
                'quantity' => 1,
            ],
            [
                'code'     => 'CF1',
                'name'     => 'Coffee ☕',
                'price'    => 11.23,
                'quantity' => 3,
            ],
            [
                'code'     => 'SR1',
                'name'     => 'Strawberry 🍓',
                'price'    => 5.00,
                'quantity' => 1,
            ],
        ];

        $pricingRules = new PricingRules();
        $cart = new Cart();
        $cashRegister = new CashRegister($pricingRules, $cart);

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

        $total = $cashRegister->getTotal();

        $this->assertSame(30.57, $total);
    }
}
