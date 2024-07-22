<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\HistoricoCalculos;
use Exception;

// include "../../vendor/autoload.php";

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
  throw new Exception("Tipo de requisição não suportado", 400);
}


class CalculoController
{

  function calcular()
  {
    $idCidade = isset($_POST['id_cidade']) && $_POST['id_cidade'] !== "" && $_POST['id_cidade'] ? $_POST['id_cidade'] : false;
    $idCategoria = isset($_POST['id_categoria']) && $_POST['id_categoria'] !== "" && $_POST['id_categoria'] ? $_POST['id_categoria'] : false;
    $enderecoOrigem = isset($_POST['endereco_origem']) && $_POST['endereco_origem'] && is_string($_POST['endereco_origem']) !== "" ? $_POST['endereco_origem'] : false;
    $enderecoDestino = isset($_POST['endereco_destino']) && $_POST['endereco_destino'] && is_string($_POST['endereco_destino']) !== "" ? $_POST['endereco_destino'] : false;


    if(!$idCidade || !$idCategoria || !$enderecoOrigem || !$enderecoDestino) {
      throw new Exception("Dados incorretos", 400);
    }

    $idCidade = filter_var($idCidade, FILTER_SANITIZE_NUMBER_INT);
    $idCategoria = filter_var($idCategoria, FILTER_SANITIZE_NUMBER_INT);
    $enderecoOrigem = filter_var($idCategoria, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $enderecoDestino = filter_var($idCategoria, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $distancia = random_int(0, 100);
    $duracao = random_int(0, 60);

    $mCategoria = new Categoria();

    $dbCategoria = $mCategoria->select("*", null, "t.id_categoria = $idCategoria");
    $tarifaFixa = $dbCategoria[0]->tarifa_fixa;
    $tarifaQuilometro = $dbCategoria[0]->tarifa_quilometro;
    $tarifaMinuto = $dbCategoria[0]->tarifa_minuto;

    $calculoTarifa = $tarifaFixa + ($tarifaQuilometro * $distancia) + ($tarifaMinuto * $duracao);

    try {
      $mHistoricoCalculos = new HistoricoCalculos();

      $mHistoricoCalculos->id_cidade = $idCidade;
      $mHistoricoCalculos->id_categoria = $idCategoria;
      $mHistoricoCalculos->endereco_origem = $enderecoOrigem;
      $mHistoricoCalculos->endereco_destino = $enderecoDestino;
      $mHistoricoCalculos->distancia = $distancia;
      $mHistoricoCalculos->duracao = $duracao;
      $mHistoricoCalculos->valor_tarifa = $calculoTarifa;

      $response = $mHistoricoCalculos->save();

    } catch (\Throwable $th) {
      throw new Exception("Erro ao tentar gravar o historico", 500);
    }

    return json_encode([
                        'distancia' => $distancia,
                        'duracao'=> $duracao,
                        'tarifa_fixa'=> $tarifaFixa,
                        'tarifa_quilometro'=> $tarifaQuilometro,
                        'tarifa_minuto'=> $tarifaMinuto,
                        'valor_tarifa'=> $calculoTarifa
                      ]);

  }

}


