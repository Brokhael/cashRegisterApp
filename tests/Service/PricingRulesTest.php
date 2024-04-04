<?php

namespace App\Tests\Service;

use App\Entity\Product;
use App\Service\PricingRules;
use PHPUnit\Framework\TestCase;

class PricingRulesTest extends TestCase
{
    public function testApplyRulesGreenTea(): void
    {
        $pricingRules = new PricingRules();
        $greenTea = new Product('GR1', 'Green Tea', 3.11);

        $this->assertEquals(3.11, $pricingRules->applyRules($greenTea, 1));
        $this->assertEquals(3.11, $pricingRules->applyRules($greenTea, 2));
        $this->assertEquals(0.00, $pricingRules->applyRules($greenTea, 0));
        $this->assertEquals(6.22, $pricingRules->applyRules($greenTea, 3));
        $this->assertEquals(6.22, $pricingRules->applyRules($greenTea, 4));
    }

    public function testApplyRulesStrawberries(): void
    {
        $pricingRules = new PricingRules();
        $strawberries = new Product('SR1', 'Strawberries', 5.00);

        $this->assertEquals(0.00, $pricingRules->applyRules($strawberries, 0));
        $this->assertEquals(5.00, $pricingRules->applyRules($strawberries, 1));
        $this->assertEquals(10.00, $pricingRules->applyRules($strawberries, 2));
        $this->assertEquals(13.50, $pricingRules->applyRules($strawberries, 3));
        $this->assertEquals(18.00, $pricingRules->applyRules($strawberries, 4));
    }

    public function testApplyRulesCoffee(): void
    {
        $pricingRules = new PricingRules();
        $coffee = new Product('CF1', 'Coffee', 11.23);

        $this->assertEquals(11.23, $pricingRules->applyRules($coffee, 1));
        $this->assertEquals(22.46, $pricingRules->applyRules($coffee, 2));
        $this->assertEquals(22.46, $pricingRules->applyRules($coffee, 3));
        $this->assertEquals(29.95, $pricingRules->applyRules($coffee, 4));
    }
}
