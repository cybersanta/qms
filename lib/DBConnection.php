<?php
class DBConnection{
	private static $_instance = null;
	private static $_connectParams = array(
		'_host'=>'localhost',
		'_user'=>'root',
		'_db'=>'qms',
		'_password'=>'');
	private function __construct(){}
	private function __clone(){}
	private function __wakeup(){}

	static public function getInstance(){
		if(is_null(self::$_instance))
		{
			self::$_instance = @new mysqli(self::$_connectParams['_host'], self::$_connectParams['_user'], self::$_connectParams['_password'], self::$_connectParams['_db']);
			self::$_instance->query("SET NAMES 'utf8'");
		}
		return self::$_instance;
	}
}