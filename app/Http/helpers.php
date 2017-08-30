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
			if ($path === '/')
				return Request::path() === $path ? ' class=active' : '';

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

if(!function_exists('oldValue')) {

	/**
	 * Retourne la valeur $value ou la valeur modifiée avant validation de formulaire
	 * 
	 * @param  String
	 * @param  mixed
	 * @return mixed
	 */
	function oldValue($field, $value)
	{
		if(old($field)) return old($field);

		return $value;
	}
}

if(!function_exists('notePercent')) {

	function notePercent($note, $total)
	{
		return $total === 0 ? 0 : round(($note * 100) / $total, 1);
	}
}