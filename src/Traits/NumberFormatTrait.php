<?php

namespace Smart\Resale\Traits;

trait NumberFormatTrait
{
    private function numberFormatReal(float $value): string
    {
        return 'R$ ' . number_format($value, "2", ",", ".");
    }
}
