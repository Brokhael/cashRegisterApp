<?php

namespace App\Tests\Service;

use App\Entity\Product;
use App\Service\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testAddItem(): void
    {
        $product1 = $this->createMock(Product::class);
        $product1->method('getCode')->willReturn('GR1');

        $product2 = $this->createMock(Product::class);
        $product2->method('getCode')->willReturn('SR1');

        $cart = new Cart();

        $cart->addItem($product1, 2);
        $this->assertSame(2, $cart->getItems()['GR1']['quantity']);

        $cart->addItem($product2, 1);
        $this->assertSame(1, $cart->getItems()['SR1']['quantity']);

        $cart->addItem($product1, 1);
        $this->assertSame(3, $cart->getItems()['GR1']['quantity']);
    }

    public function testGetItems(): void
    {
        $product1 = $this->createMock(Product::class);
        $product1->method('getCode')->willReturn('GR1');

        $product2 = $this->createMock(Product::class);
        $product2->method('getCode')->willReturn('SR1');

        $cart = new Cart();

        $cart->addItem($product1, 2);
        $cart->addItem($product2, 1);

        $items = $cart->getItems();

        $this->assertArrayHasKey('GR1', $items);
        $this->assertSame(2, $items['GR1']['quantity']);

        $this->assertArrayHasKey('SR1', $items);
        $this->assertSame(1, $items['SR1']['quantity']);
    }
}
