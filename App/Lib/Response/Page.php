<?php
	
namespace App\Lib\Response;

class Page
{
	function View($view, $tmpl = NULL)
	{
		include_once BASEPATH . 'App/Views/' . $view . '.php';
	}
}
