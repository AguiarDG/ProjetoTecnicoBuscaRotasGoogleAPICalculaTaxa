<?php

namespace Api;

use App\Models\CidadeHasCategoria;
use App\Models\HistoricoCalculos;
use Exception;

include "../vendor/autoload.php";

if($_SERVER['REQUEST_METHOD'] !== 'GET') {
  throw new Exception("Tipo de requisição não suportado", 400);
}

$idCidade = isset($_GET['id_cidade']) && $_GET['id_cidade'] !== "" && $_GET['id_cidade'] ? $_GET['id_cidade'] : false;

if (!$idCidade) {
  throw new Exception("Dados incorretos", 400);
}

$idCidade = filter_var($idCidade, FILTER_SANITIZE_NUMBER_INT);

$mCidadeHasCategoria = new CidadeHasCategoria();
$dbCidadeHasCategoria = $mCidadeHasCategoria->select("*", "JOIN categorias c ON t.id_categoria = c.id_categoria", "t.id_cidade = $idCidade", "c.categoria ASC");

$result = [];

foreach ($dbCidadeHasCategoria as $key => $categoria) {
  $result[] = $categoria->categoria;
}

return json_encode($result);
