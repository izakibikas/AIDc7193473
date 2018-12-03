<?php

class DB
{
	private static $mysqli;

	public static function getInstance(){
		if (!is_object(self::$mysqli)){
			self::$mysqli = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
			self::$mysqli->set_charset("utf8");
		}
		return self::$mysqli;
	}
	
}