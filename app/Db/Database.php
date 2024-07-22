<?php

namespace App\Db;

use \PDO;
use PDOException;

class DataBase {

  const host = 'localhost';

  const dbname = 'project_routes_googleapi';

  const username = 'admin';

  const password = 'admin';

  private $table;

  private $connection;
  
  public function __construct($table = null)
  {
    $this->table = $table;
    $this->createConnection();
  }

  function createConnection()
  {
    try {
      $this->connection = new PDO("mysql:host=".self::host.";dbname=".self::dbname, self::username, self::password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      die("ERROR: ".$e->getMessage());
    }
  }

  public function execute($query, $params = [])
  {
    try {
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement->fetchAll(PDO::FETCH_CLASS);
    } catch (PDOException $e) {
      die("ERROR: ".$e->getMessage());
    }
  }

  public function select($fields = "*", $joins = null, $where = null, $order = null, $limit = null)
  {
    $joins = isset($joins) ? $joins : "";
    $where = isset($where) ? "WHERE $where" : "";
    $order = isset($order) ? "ORDER BY $order" : "";
    $limit = isset($limit) ? "LIMIT $limit" : "";

    $query = "SELECT $fields FROM " . $this->table . " t $joins $where $order $limit;";

    return $this->execute($query);
  }

  public function insert($values)
  {
    $fields = array_keys($values);
    $binds  = array_pad([],count($fields),'?');

    $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

    $this->execute($query,array_values($values));

    return $this->connection->lastInsertId();
  }
}