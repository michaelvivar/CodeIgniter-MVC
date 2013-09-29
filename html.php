<?php

function array_merge_unique()
{
	$args = func_get_args();
	$array = array();
	foreach ($args as $arg)
	{
		$array = array_unique(array_merge($array, $arg));
	}
	return $array;
}

function set_attributes($key, $val)
{
	return $key . '="' . $val . '"';
}


function get_attributes($attributes)
{
	$mapped = array_map('set_attributes', array_keys($attributes), array_values($attributes));
	$space = (count($mapped) > 0) ? ' ' : '';
	return $space . implode(' ', $mapped);
}

class Html
{
	public $elements = array();
	
	public function add($element)
	{
		$this->elements[$element->name] =& $element;
		return $element;
	}
	
	public function get($name)
	{
		return isset($this->elements[$name]) ? $this->elements[$name] : FALSE;
	}
	
	public function input($name, $attributes = array())
	{
		if ( ! isset($this->elements[$name]))
		{
			$attribute = array_merge_unique($attributes, array('name' => $name));
		}
		else
		{
			$attribute = array_merge_unique($this->get($name)->attribute(), $attributes, array('type' => 'text'));
		}
		echo '<input' . get_attributes($attribute) . '/>';
	}
}

class Element
{
	public $name;
	public $attributes = array();
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function attribute()
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
				$this->attributes = array_merge_unique($this->attributes, $args[0]);
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

class InputField extends Element
{
	public $value;
	public $options = array();
	public $validations = array();
	
	public function validation()
	{
		$args = func_get_args();
		if ( ! isset($args[0]))
		{
			return $this->validations;
		}
		else
		{
			if (is_array($args[0]))
			{
				$this->validations = array_merge($this->validations, $args[0]);
			}
			else
			{
				if ( ! isset($args[1]))
				{
					return isset($this->validations[$args[0]]) ? $this->validations[$args[0]] : FALSE;
				}
				else
				{
					$this->validations[$args[0]] = $args[1];
				}
			}
			return $this;
		}
	}
}
