<?php

namespace App\Models;

use App\Db\Database;

class Categoria extends DataBase
{
  public $table = "categorias";
  public $id_categoria;
  public $categoria;
  public $tarifa;

  public function __construct() {
    parent::__construct($this->table);
  }
}
