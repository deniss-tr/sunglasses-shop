<?php

class Dbh {
  // private $host = 'localhost';
  // private $dbName = 'sitelia';
  // private $login = 'root';
  // private $password = 'root';

  public function __construct()
  {
    $this->dbh = new PDO("sqlite:start.db");
  }

  public function connect() 
  {
    return $this->dbh;
  }
}