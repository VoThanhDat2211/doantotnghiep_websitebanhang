<?php

use Illuminate\Support\Str;

if (!function_exists('toUpperCase')) {
    function toUpperCase($str) 
    {
        return Str::upper($str);
    }
}

if (!function_exists('priceFormat')) {
    function priceFormat($amount)
    {
        return number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('priceDiscount')) {
    function priceDiscount($priceOrigin, $discount)
    {
        return $priceOrigin - (int)$priceOrigin * $discount / 100;
    }
}

if (!function_exists('renderSize')) {
    function renderSize($keySize) 
    {
        return config('variant.size')[$keySize];
    }
 }