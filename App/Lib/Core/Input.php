<?php

namespace App\Lib\Core;

use App\Lib\Core\Security;

class Input
{
	private static $_post = array();
	private static $_get = array();
	
	public function __construct()
	{
		if (isset($_POST))
		{
			self::$_post = $_POST;
			unset($_POST);
		}
		if (isset($_GET))
		{
			self::$_get = $_GET;
			unset($_GET);
		}
	}
	
	public static function Get($index = NULL, $xss_clean = FALSE)
	{
		if ($index === NULL)
		{
			if (empty(self::$_get))
			{
				return array();
			}

			$get = array();

			foreach (array_keys(self::$_get) as $key)
			{
				$get[$key] = self::_Fetch(self::$_get, $key, $xss_clean);
			}
			return $get;
		}
		return self::_Fetch(self::$_get, $index, $xss_clean);
	}
	
	public static function Post($index = NULL, $xss_clean = FALSE)
	{
		if ($index === NULL)
		{
			if (empty(self::$_post))
			{
				return array();
			}
	
			$post = array();
	
			foreach (array_keys(self::$_post) as $key)
			{
				$post[$key] = self::_Fetch(self::$_post, $key, $xss_clean);
			}
			return $post;
		}
		return self::_Fetch(self::$_post, $index, $xss_clean);
	}
	
	private static function _Fetch(&$array, $index = '', $xss_clean = FALSE)
	{
		if (isset($array[$index]))
		{
			$value = $array[$index];
		}
		elseif (($count = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches)) > 1) // Does the index contain array notation
		{
			$value = $array;
			for ($i = 0; $i < $count; $i++)
			{
				$key = trim($matches[0][$i], '[]');
				if ($key === '') // Empty notation will return the value as array
				{
					break;
				}
	
				if (isset($value[$key]))
				{
					$value = $value[$key];
				}
				else
				{
					return NULL;
				}
			}
		}
		else
		{
			return NULL;
		}
	
		return ($xss_clean === TRUE)
		? Security::XssClean($value)
		: $value;
	}
}
