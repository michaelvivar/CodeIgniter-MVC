<?php

namespace App\Lib;

class Page
{
	private $_template = 'shared/layout';
	private $_title = '';
	private $_content = FALSE;
	
	public function Template($template = FALSE)
	{
		if ($template === FALSE)
		{
			return $this->_template;
		}
		$this->_template = $template;
	}
	
	public function Title($title = FALSE)
	{
		if ($title === FALSE)
		{
			return $this->_title;
		}
		$this->_title = $title;
	}
	
	public function Content($content = FALSE)
	{
		if ($content === FALSE)
		{
			return $this->_content;
		}
		$this->_content = $content;
	}
}
