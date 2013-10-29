<?php
	
namespace Core;

class Main
{
	function __construct($routes)
	{
		$class = '\\App\\Controllers\\' . $routes->controller . 'Controller';
		call_user_func_array(array(new $class, $routes->action), $routes->params);
	}
}
