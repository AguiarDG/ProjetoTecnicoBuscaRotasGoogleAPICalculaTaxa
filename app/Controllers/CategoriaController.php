<?php

namespace App\Controllers;

use App\Models\Categoria;

class CategoriaController
{
  
  function getCategorias()
  {
    $mCategoria = new Categoria();

    $dbCategorias = $mCategoria->select();

    return $dbCategorias;
  }

  function getCategoria($idCategoria)
  {
    $mCategorias = new Categoria();

    $dbCategoria = $mCategorias->select("*", null, "t.id_categoria = $idCategoria");

    return $dbCategoria;
  }
}
