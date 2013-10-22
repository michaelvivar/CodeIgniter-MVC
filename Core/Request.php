<?php

namespace Core;
	
class Request
{
	private $uri = '';
	private $segments = array();
	
	function __construct()
	{
		$this->uri()->segments();
		new Routes($this->segments);
	}
	
	function uri()
	{
		//$this->uri = preg_replace('/^\/|\/$/', '', (isset($_GET['querystring'])) ? $_GET['querystring'] : '');
		$this->uri = preg_replace('/^\/|\/$/', '', $_SERVER['REQUEST_URI']);
		return $this;
	}
	
	function segments()
	{
		$this->segments = explode('/', $this->uri);
	}
}
