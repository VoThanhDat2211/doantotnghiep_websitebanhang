<?
use Illuminate\Support\Str;
if(!function_exists('toUpperCase')) {
    function toUpperCase($str) 
    {
        return Str::upper($str);
    }
}

if (!function_exists('priceFormat')) {
    function priceFormat($amount)
    {
        return number_format($amount, 2, '.', ',');
    }
}