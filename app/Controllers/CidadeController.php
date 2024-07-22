<?php

namespace App\Controllers;

use App\Models\Cidade;

class CidadeController
{
  
  function getCidades()
  {
    $mCidades = new Cidade();

    $dbCidades = $mCidades->select();

    return $dbCidades;
  }

  function getCidade($idCidade)
  {
    $mCidades = new Cidade();

    $dbCidade = $mCidades->select("*", null, "t.id_cidade = $idCidade");

    return $dbCidade;
  }
}
