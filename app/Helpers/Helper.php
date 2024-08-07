<?
use Illuminate\Support\Str;
if(!function_exists('toUpperCase')) {
    function toUpperCase($str) 
    {
        return Str::upper($str);
    }
}