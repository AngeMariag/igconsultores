<?php

use utils\bd\bd\ORM;

namespace utils\bd\bd;

class Model extends ORM
{
	private $data = array();
	protected static $table;
	function __construct($data = Null)
	{
		// parent::__construct();
		$this->data = $data;
	}
	function __get($name)
	{
		$nam = $this->data;
		if (array_key_exists($name, $nam)) {
			return $this->data[$name];
		}
	}
	function __set($name, $value)
	{
		$this->data[$name] = $value;
	}
	function getColumns()
	{
		return $this->data;
	}
}
