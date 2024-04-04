<?php

namespace App\Service;

use App\Entity\Product;

class PricingRules
{
    public const STRAWBERRIES_DC_PRICE = 4.5;
    public const STRAWBERRIES_DC_TRESHHOLD = 3;
    public const COFFEE_DC_RATIO = 2 / 3;
    public const COFFEE_DC_TRESHHOLD = 3;

    public function applyRules(Product $product, int $quantity): float
    {
        return match ($product->getCode()) {
            'GR1' => $this->applyBOGOF($product, $quantity),
            'SR1' => $this->applyVolumeDiscount($product, $quantity, self::STRAWBERRIES_DC_PRICE, self::STRAWBERRIES_DC_TRESHHOLD),
            'CF1' => $this->applyVolumeDiscount($product, $quantity, $product->getPrice() * self::COFFEE_DC_RATIO, self::COFFEE_DC_TRESHHOLD),
            default => $product->getPrice() * $quantity,
        };
    }

    private function applyBOGOF(Product $product, int $quantity): float
    {
        $price = $product->getPrice();
        $freePairs = intdiv($quantity, 2);

        return round(($quantity - $freePairs) * $price, 2);
    }

    private function applyVolumeDiscount(Product $product, int $quantity, float $discountPrice, int $discountThreshold): float
    {
        $price = $product->getPrice();

        return round(
            $discountThreshold <= $quantity ?
                $quantity * $discountPrice :
                $quantity * $price,
            2
        );
    }
}