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

if (!function_exists('classActivePath')) {

		function classActivePath($path)
		{	
			$reg = '#'.$path.'#';
            
			return preg_match($reg, Request::path()) ? ' class=active' : '';
		}
}

if(!function_exists('selected_fields')) {

	function selected_fields($name, $data, $checked='checked')
	{
		if(is_array($data) && !empty($data) && in_array($name, $data)) return $checked ;

		if( $name == $data ) return $checked;
	}
}