<?php

namespace App\Models;

use App\Db\Database;

class CidadeHasCategoria extends DataBase
{
  public $table = "cidade_has_categoria";
  public $id_cidade;
  public $id_categoria;

  public function __construct() {
    parent::__construct($this->table);
  }
}
