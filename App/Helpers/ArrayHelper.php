<?php

namespace App\Helpers;

class ArrayHelper
{
	function merge_unique($array1 = array(), $array2 = array(), $array3 = array())
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
}
