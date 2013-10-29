<?php

namespace App\Lib\Core;

class Config
{
	private static $_config = array();
	
	public function __construct()
	{
		self::Load('site');
	}
	
	public static function Load($file = '')
	{
		$file_path = BASEPATH.'/App/config/'.$file.'.php';
		
		if (file_exists($file_path))
		{
			include_once $file_path;
			
			if ( ! isset($config) OR ! is_array($config))
			{
				return FALSE;
			}
			else
			{
				self::$_config = array_merge(self::$_config, $config);
			}
		}
		
		return FALSE;
	}
	

	public static function Item($item, $index = '')
	{
		if ($index == '')
		{
			$index = 'site';
		}
	
		return isset(self::$_config[$index], self::$_config[$index][$item]) ? self::$_config[$index][$item] : NULL;
	}
}
