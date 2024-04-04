<?php

namespace App\Tests\Service;

use App\Entity\Product;
use App\Service\CashRegister;
use App\Service\Cart;
use App\Service\PricingRules;
use PHPUnit\Framework\TestCase;

class CashRegisterTest extends TestCase
{
    public function testScanProduct(): void
    {
        $pricingRules = $this->createMock(PricingRules::class);
        $cart = $this->createMock(Cart::class);
        $cashRegister = new CashRegister($pricingRules, $cart);

        $product = $this->createMock(Product::class);
        $quantity = 2;

        $cart->expects($this->once())
            ->method('addItem')
            ->with($product, $quantity);

        $cashRegister->scanProduct($product, $quantity);
    }

    public function testGetTotal(): void
    {
        $pricingRules = $this->createMock(PricingRules::class);
        $cart = $this->createMock(Cart::class);
        $cashRegister = new CashRegister($pricingRules, $cart);

        $product1 = $this->createMock(Product::class);
        $product1->method('getCode')->willReturn('GR1');

        $product2 = $this->createMock(Product::class);
        $product2->method('getCode')->willReturn('SR1');

        $cart->method('getItems')->willReturn([
            'GR1' => ['product' => $product1, 'quantity' => 2],
            'SR1' => ['product' => $product2, 'quantity' => 1],
        ]);

        $pricingRules->expects($this->exactly(2))
            ->method('applyRules')
            ->willReturn(3.11, 5.00);

        $total = $cashRegister->getTotal();
        $this->assertSame(8.11, $total);
    }
}
