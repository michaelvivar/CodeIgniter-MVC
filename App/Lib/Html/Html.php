<?php

namespace App\Lib\Html;

use App\Helpers\ArrayHelper;
use App\Helpers\HtmlHelper;

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
	
	protected function set_attributes($key, $val)
	{
		return $key . '="' . $val . '"';
	}
	
	
	protected function get_attributes($attributes)
	{
		$html = '';
		foreach ($attributes as $key => $val)
		{
			$html .= ' '. $key .'="'. $val .'"';
		}
		return $html;
	}
	
	protected function get_options($options, $value = FALSE)
	{
		$html = '';
		foreach ($options as $key => $val)
		{
			$attr = '';
			if ($key == $value) {  $attr = ' selected="selected" '; }
			$html .= '<option ' . $attr . 'value="' . $key . '">' . $val . '</option>';
		}
		return $html;
	}
	
	public function label($name = FALSE)
	{
		if ($name === FALSE) { return; }
		if ( ! isset($this->elements[$name]))
		{
			echo '<label>'. $name .'</label>';
		}
		else
		{
			echo '<label for="'. $this->get($name)->name .'">'. $this->get($name)->label .'</label>';
		}
	}
	
	public function input($name = FALSE, $attributes = array())
	{
		if ($name === FALSE) { return; }
		if ( ! isset($this->elements[$name]))
		{
			$attribute = ArrayHelper::merge_unique($attributes, array('name' => $name), array('type' => 'text'));
		}
		else
		{
			$attribute = ArrayHelper::merge_unique($this->get($name)->attribute(), $attributes, array('type' => 'text'));
		}
		echo '<input' . $this->get_attributes($attribute) . '/>';
	}
	
	public function select($name = FALSE, $options = array(), $value = FALSE, $attributes = array())
	{
		if ($name === FALSE) { return; }
		if ( ! isset($this->elements[$name]))
		{
			$attribute = ArrayHelper::merge_unique($attributes, array('name' => $name));
			$option = is_array($options) ? $options : array();
		}
		else
		{
			$attribute = ArrayHelper::merge_unique($this->get($name)->attribute(), $attributes);
			$option = $this->get($name)->options;
			$value = $this->get($name)->value;
		}
		echo '<select' . $this->get_attributes($attribute) . '>' . $this->get_options($option, $value) . '</select>';
	}
}
