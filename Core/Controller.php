<?php
	
namespace Core;

class Controller
{
	private static $instance;
	
	function __construct()
	{
		self::$instance =& $this;
	}
	
	public static function &get_instance()
	{
		return self::$instance;
	}
}
