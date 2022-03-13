<?php
namespace Application\models;

use Application\core\Database;
use PDO;

class UsersModel
{


  public function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('select * from users');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function find(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('select * from users from id = :id limit 1', [':id' => $id]);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

}
