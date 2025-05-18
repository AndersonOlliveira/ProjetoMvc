<?php


namespace App\Models;
use App\Connection;
use mysqli;

class Dados {

    protected $mysql;

    public function __construct(mysqli $mysql)
    {
         $this->mysql = $mysql;

    }

    public function getDados()
    {
           $query = "SELECT * FROM usuarios";

           return $this->mysql->query($query)->fetch_all();
    }
}