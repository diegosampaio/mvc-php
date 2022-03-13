<?php
namespace Application\core;

use PDO;

class Database extends PDO
{
  // configuração de conexão do BD
  private $dbName = 'mbaco142_academico';
  private $dbUser = 'root';
  private $dbPass = 'root';
  private $dbHost = 'localhost';
  private $dbPorta = 3306;
  private $conn;

  public function __construct()
  {
    $this->conn = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPass);    
  }

  private function setParameters($stmt, $key, $value)
  {
    $stmt->bindParam($key, $value);
  }

  private function mountQuery($stmt, $parameters)
  {
    foreach ( $parameters as $key => $value ) {
      $this->setParameters($stmt, $key, $value);
    }
  }

  public function executeQuery(string $query, array $parameters = [])
  {
    $stmt = $this->conn->prepare($query);
    $this->mountQuery($stmt, $parameters);
    $stmt->execute();
    return $stmt;
  }

}
