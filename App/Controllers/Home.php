<?php
	
namespace App\Controllers;

use Core\Controller;
use App\Lib\Response\Page;
use App\Models\User\LoginFormModel;

class Home extends Controller
{
	function Index()
	{
		$form = new LoginFormModel();
		Response::Page('Home/Index', array('form' => $form), $page);
	}
}
