<?php

namespace UNIS\Di;

class Container
{
	public static function getClass($name)
	{
		$strClass = "\\App\\Models\\" . ucfirst($name);
		$class = new $strClass(\App\Init::getDb());
		return $class;
	}
}