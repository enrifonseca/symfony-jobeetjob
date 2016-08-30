<?php
class Jobeet{
	//	Reemplaza caracteres no ASCCI por - (guion medio)
	public static function slugify($text){
		return strtolower(trim(preg_replace('/\W+/', '-', $text), '-'));
	}

	public static function getTime(){
		return date('Y-m-d h:i:s', time());
	}
}
?>