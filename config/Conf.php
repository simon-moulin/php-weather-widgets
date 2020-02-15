<?php
	class Conf{

	static private $debug = True;
		static private $database = array(
			'hostname' => '',
			'database' => '',
			'login' => '',
			'password' => ''
		);


	static public function getDebug(){
		return self::$debug;
	}

	static public  function getHostname(){
		return self::$database['hostname'];
	}

	static public  function getDatabase(){
		return self::$database['database'];
	}

	static public  function getLogin(){
		return self::$database['login'];
	}

		static public  function getPassword(){
		return self::$database['password'];
	}

}
?>