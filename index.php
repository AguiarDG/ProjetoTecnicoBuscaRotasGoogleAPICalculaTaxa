<?php

use App\Controllers\CidadeController;
use App\Controllers\CategoriaController;
use App\Controllers\CalculoController;

include "./vendor/autoload.php";

$calcular = $_POST['calculando'];
$_POST['calculando'] = 0;


$cidadeController = new CidadeController();

$dbCidades = $cidadeController->getCidades();

$selectCidades = "";
foreach ($dbCidades as $key => $cidade) {
  $selectCidades .= "<option value='$cidade->id_cidade'> $cidade->cidade </option>";
}

$categoriaController = new CategoriaController();

$dbCategorias = $categoriaController->getCategorias();

$selectCategorias = "";
foreach ($dbCategorias as $key => $categoria) {
  $selectCategorias .= "<option value='$categoria->id_categoria'> $categoria->categoria </option>";
}

if(isset($calcular) && $calcular == 1) {
  $cCalculo = new CalculoController();

  $response = $cCalculo->calcular();

  $response = json_decode($response);

  $cidade = $cidadeController->getCidade($_POST['id_cidade']);
  $categoria = $categoriaController->getCategoria($_POST['id_categoria']);

  $historicoDeCalculos = "<tr>" .
                            "<td>".$cidade[0]->cidade."</td>" .
                            "<td>".$categoria[0]->categoria."</td>" .
                            "<td>$response->distancia</td>" .
                            "<td>$response->duracao</td>" .
                            "<td>$response->valor_tarifa</td>" .
                          "</tr>";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="custom-style.css">
  <title>Avaliação Tecnica</title>
</head>
<body>
  <div class="container mb-5">
      <h1>Avaliação Tecnica</h1>

      <div class="container">
        <div class="form-calculo">
          <form method="post">

            <div class="form-group">
              <input type="hidden" name="calculando" id="calculando" value="1">
            </div>

            <div class="form-group">
              <label for="id_cidade">Cidade</label> <br />
              <select name="id_cidade" id="id_cidade" onchange="carregaCategoria()">
                <?=$selectCidades?>
              </select>
            </div>

            <div class="form-group">
              <label for="id_categoria">Categoria</label> <br />
              <select name="id_categoria" id="id_categoria">
                <?=$selectCategorias?>
              </select>
            </div>

            <div class="form-group">
              <label for="endereco_origem">Endereço Origem</label> <br />
              <input type="text" name="endereco_origem" id="endereco_origem">
            </div>

            <div class="form-group">
              <label for="endereco_destino">Endereço Destino</label> <br />
              <input type="text" name="endereco_destino" id="endereco_destino">
            </div>

            <div>
              <button type="submit" class="btn btn-success">Calcular Tarifa</button>
            </div>
          </form>
        </div>

        <div>
          <h3 class="center">Historico de Calculos</h3>

          <table>
            <thead>
              <tr>
                <th>Cidade</th>
                <th>Categoria</th>
                <th>Distancia</th>
                <th>Duração</th>
                <th>Tarifa</th>
              </tr>
            </thead>
            <tbody>
              <?=$historicoDeCalculos?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script>
      function carregaCategoria() {
        const selectCidade = document.getElementById("cidade");
        const cidadeSelecionada = selectCidade.value;

        console.log(cidadeSelecionada);
      }
    </script>

</body>
</html>