<?php

function array_merge_unique($array1 = array(), $array2 = array(), $array3 = array())
{
	foreach ($array2 as $key => $val)
	{
		if ( ! isset($array1[$key]))
		{
			$array1[$key] = $val;
		}
	}
	foreach ($array3 as $key => $val)
	{
		if ( ! isset($array1[$key]))
		{
			$array1[$key] = $val;
		}
	}
	return $array1;
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

function get_options($options, $value = FALSE)
{
	$html = '';
	foreach ($options as $key => $val)
	{
		$attr = '';
		if ($key == $value){  $attr = ' selected="selected" '; }
		$html .= '<option' . $attr . 'value="' . $key . '">' . $val . '</option>';
	}
	return $html;
}

class Html
{
	public $elements = array();
	
	public function add($element)
	{
		$element->attributes['name'] = $element->name;
		$this->elements[$element->name] =& $element;
		return $element;
	}
	
	public function get($name)
	{
		return isset($this->elements[$name]) ? $this->elements[$name] : FALSE;
	}
	
	public function input($name = FALSE, $attributes = array())
	{
		if ($name === FALSE) { return; }
		if ( ! isset($this->elements[$name]))
		{
			$attribute = array_merge_unique($attributes, array('name' => $name), array('type' => 'text'));
		}
		else
		{
			$attribute = array_merge_unique($this->get($name)->attribute(), $attributes, array('type' => 'text'));
		}
		echo '<input' . get_attributes($attribute) . '/>';
	}
	
	public function select($name = FALSE, $options = array(), $value = FALSE, $attributes = array())
	{
		if ($name === FALSE) { return; }
		if ( ! isset($this->elements[$name]))
		{
			$attribute = array_merge_unique($attributes, array('name' => $name));
			$option = is_array($options) ? $options : array();
		}
		else
		{
			$attribute = array_merge_unique($this->get($name)->attribute(), $attributes);
			$option = $this->get($name)->options;
			$value = $this->get($name)->value;
		}
		echo '<select' . get_attributes($attribute) . '>' . get_options($option, $value) . '</select>';
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
	
	public function validation(/* [string $name], [string $name, string $value], [array $validations], [NULL] */)
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
