<?php

namespace App\Lib\Html;

use App\Helpers\ArrayHelper;

class Element
{
	public $name;
	public $attributes = array();
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function attribute(/* [string $name], [string $name, string $value], [array $attributes], [NULL] */)
	{
		$args = func_get_args();
		if ( ! isset($args[0]))
		{
			return $this->attributes;
		}
		else
		{
			if (is_array($args[0]))
			{
				$this->attributes = ArrayHelper::merge_unique($this->attributes, $args[0]);
			}
			else
			{
				if ( ! isset($args[1]))
				{
					return isset($this->attributes[$args[0]]) ? $this->attributes[$args[0]] : FALSE;
				}
				else
				{
					$this->attributes[$args[0]] = $args[1];
				}
			}
			return $this;
		}
	}
}
