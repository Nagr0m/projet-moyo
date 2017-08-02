<?php

if (!function_exists('plural_string'))
{
    function plural_string ($values)
    {
        if (count($values) > 1) return 's';
        if (is_numeric($values) && $values > 1) return 's';
        
        return;
    }
}