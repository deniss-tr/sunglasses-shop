<?php

class Dbh {
  private $host = 'localhost';
  private $dbName = 'sitelia';
  private $login = 'root';
  private $password = 'root';

  public function __construct()
  {
    $this->dbh = new PDO("mysql:host=$this->host; dbname=$this->dbName", $this->login, $this->password);
  }

  protected function connect() 
  {
    return $this->dbh;
  }
}