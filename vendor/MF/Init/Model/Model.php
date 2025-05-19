<?php


namespace MF\Init\Model;

use mysqli;

abstract class Model {

	protected $mysqli;
     //chamo o mysqli para liberar as model crio o conctruct da classe e chamo nas App\model
	public function __construct(\mysqli $mysqli) {
		$this->mysqli = $mysqli;
	}
}


?>