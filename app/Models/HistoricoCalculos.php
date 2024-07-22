<?php

namespace App\Models;

use App\Db\Database;

class HistoricoCalculos extends DataBase
{
  public $table = "historico_calculos";
  public $id_cidade;
  public $id_categoria;
  public $endereco_origem;
  public $endereco_destino;
  public $distancia;
  public $duracao;
  public $valor_tarifa;

  public function __construct() {
    parent::__construct($this->table);
  }

  function save()
  {
    $db = new DataBase($this->table);
    $this->id_historico_calculo = $db->insert([
                                                'id_cidade' => $this->id_cidade,
                                                'id_categoria' => $this->id_categoria,
                                                'endereco_origem' => $this->endereco_origem,
                                                'endereco_destino' => $this->endereco_destino,
                                                'distancia' => $this->distancia,
                                                'duracao' => $this->duracao,
                                                'valor_tarifa' => $this->valor_tarifa
                                              ]);

    return $this->id_historico_calculo;
  }
}
