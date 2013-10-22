<?php

namespace App\Models\User;

use App\Lib\Html\Html;
use App\Lib\Html\InputField;

class LoginFormModel extends Html
{
	function __construct()
	{
		//$this->add(new InputField('email'))->attribute(array('id' => 'emailAddress'));
		$email = new InputField('email');
		$email->label('Email Address');
		$email->attribute(array('id' => 'emailAddress'));
		$this->add($email);
		//$this->add(new InputField('country'))->value('63')->options(array('01' => 'USA', '63' => 'Philippines'));
		$country = new InputField('country');
		$country->value('63');
		$country->options(array('01' => 'USA', '63' => 'Philippines'));
		$this->add($country);
	}
}
