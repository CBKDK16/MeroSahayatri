<?php
	function requireValidation($data,$index)
	{
		if(isset($data[$index]) && !empty($data[$index]) && trim($data[$index]))
			return true;
		else
			return false;
	} 
	function displayError($array,$index)
	{
		$msg = '';
		if(isset($array[$index]))
		{
			$msg = '<b><span class="error">' . $array[$index] . '</span></b>';
		}
		return $msg;
	}

?>