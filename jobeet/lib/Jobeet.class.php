<?php
class Jobeet{
	//	Reemplaza caracteres no ASCCI por - (guion medio)
	public static function slugify($text){
		$text = trim(preg_replace('#[^\\pL\d]+#u', '-', $text), '-');

		if(function_exists('iconv'))
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		$text = preg_replace('#[^-\w]+#', '', strtolower($text));

		return empty($text) ? 'n-a' : $text;
	}

	public static function getTime(){
		return date('Y-m-d h:i:s', time());
	}
}
?>