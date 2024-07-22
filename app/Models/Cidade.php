<?php

namespace App\Models;

use App\Db\Database;

class Cidade extends DataBase
{
  public $table = "cidades";
  public $id_cidade;
  public $cidade;

  public function __construct() {
    parent::__construct($this->table);
  }

}