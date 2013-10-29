<?php

namespace App\Lib;

class Response
{
	public static function View($file, $data = array(), $content = FALSE)
	{
		foreach ($data as $key => $var)
		{
			$$key = $var;
		}
		
		ob_start();
		
		include BASEPATH . '/App/Views/'. $file . '.php';
		
		if ($content === TRUE)
		{
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}
		
		ob_end_flush();
	}
	
	public static function Page($file, $data = array(), $page)
	{
		$content = self::View($file, $data, TRUE);
		$page->Content($content);
		self::View($page->Template(), array('page' => $page));
	}
	
	public static function Content($text)
	{
		
	}
	
	public static function Json($data)
	{
		
	}
}
