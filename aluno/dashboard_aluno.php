<?php

include_once("../api/conexao.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=naoautorizado");
    exit();
}

include("includes/header_aluno.php");
include("includes/menu_aluno.php");

?>
  

  <!-- MODAL ENVIAR CIFRA -->
<form action="../api/enviar_cifra.php" method="POST" enctype="multipart/form-data">

    <input type="text" name="nome_musica" class="form-control" placeholder="Nome da música" required>

    <input type="text" name="autor" class="form-control" placeholder="Autor" required>

    <input type="text" name="versao" class="form-control" placeholder="Versão">

    <select name="tipo" class="form-select">
        <option value="cifra">Cifra</option>
        <option value="tablatura">Tablatura</option>
        <option value="partitura">Partitura</option>
    </select>

    <input
        type="file"
        name="arquivo"
        accept=".doc,.docx"
        class="form-control"
        required>

    <button class="btn btn-success">
        Enviar
    </button>

</form>

    <!-- ASSINATURAS -->
    <div id="assinaturas" class="container mt-4" style="display: none;">
     <h2 class="mb-4">Assinaturas</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Free</h5>
              <p class="card-text">Recursos disponíveis: </p>
              <p class="card-text"><small class="text-muted">R$0,00</small></p>
            </div>
            <div class="card-footer d-flex justify-content-between"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- LISTAS -->
   <div id="listas-musicas" class="container mt-4" style="display: none;">
    <h2 class="txt-body">Minhas listas</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Nome da Lista</h5>
              <p class="card-text">Autor: </p>
              <p class="card-text"><small class="text-muted">Versão: Simplificada</small></p>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="#" class="btn btn-sm btn-outline-primary">Ver Cifras</a>
              <button class="btn btn-sm btn-outline-danger">Excluir</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include(__DIR__ . "/includes/footer_aluno.php");?>