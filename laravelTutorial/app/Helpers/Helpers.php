<?php

// Convert price to int format
if (!function_exists('convertPriceToInteger')) {
    function convertPriceToInteger($price)
    {
        $priceString = str_replace([',', '.00'], '', $price);
        return (int) str_replace('.', '', $priceString);
    }
}
