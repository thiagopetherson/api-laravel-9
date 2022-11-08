<?php

namespace App\Helpers;

class ProductHelper
{
    /**
     * Método formatValue (Formatar para moeda)
     * @param int $value
     * @return string
    */
    
    public static function formatValue($value){        
        return "R$ " . number_format($value,2,",",".");
    }
}