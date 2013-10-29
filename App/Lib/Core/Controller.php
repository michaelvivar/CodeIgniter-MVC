<?php

namespace App\Lib\Core;

class Controller
{
	private static $instance;
	
	function __construct()
	{
		self::$instance =& $this;
		
		new Config();
		new Input();
	}
	
	public static function &get_instance()
	{
		return self::$instance;
	}
}
