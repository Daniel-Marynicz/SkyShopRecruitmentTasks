<?php

declare(strict_types=1);

namespace App\Tasks\Task04\Domain\Product;

use App\Tasks\Task04\Domain\Traits\Color;

class BicycleLighting extends Product
{
    use Color;

    /**
     * Light intensity .eg 50 lm
     */
    private string $intensity;

    public function getIntensity() : string
    {
        return $this->intensity;
    }

    public function setIntensity(string $intensity) : BicycleLighting
    {
        $this->intensity = $intensity;

        return $this;
    }
}
