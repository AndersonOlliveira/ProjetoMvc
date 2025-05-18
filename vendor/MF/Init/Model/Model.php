<?php


namespace MF\Init\Model;

use mysqli;

abstract class Model {

	protected $mysqli;

	public function __construct(\mysqli $mysqli) {
		$this->mysqli = $mysqli;
	}
}


?>