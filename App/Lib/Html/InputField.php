<?php

namespace App\Lib\Html;

use App\Lib\Html\Element;

class InputField extends Element
{
	/**
	 * @var string $value
	 */
	public $value;
	/**
	 * @var string $label
	 */
	public $label;
	/**
	 * @var array $options
	 */
	public $options = array();
	/**
	 * @var array $validations
	 */
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
	
	/**
	 * @access public
	 * @param array $options
	 * @param NULL
	 * @return Element
	 */
	public function options($set = NULL)
	{
		if (is_array($set))
		{
			$this->options = $set;
			return $this;
		}
	}
	
	/**
	 * @access public
	 * @param string $label;
	 * @return Element
	 */
	public function label($set = NULL)
	{
		if ($set !== NULL)
		{
			$this->label = $set;
			return $this;
		}
	}
	
	/**
	 * @param string $value
	 * @param NULL
	 * @return string or Element
	 */
	public function value($set = NULL)
	{
		if ($set === NULL)
		{
			return $this->value;
		}
		else
		{
			$this->value = $set;
			return $this;
		}
	}
}
