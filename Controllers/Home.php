<?php
	
namespace App\Controllers;

use Core\Controller;
use App\Lib\Response\Page;
use App\Models\User\LoginFormModel;

class Home extends Controller
{
	function Index()
	{
		$this->form = new LoginFormModel();
		Page::View('Home/Index');
	}
}
