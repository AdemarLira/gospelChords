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
<div class="modal fade" id="modal-upload" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="uploadModalLabel">Enviar Cifra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        
        <div class="modal-body">
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Música</span>
            <input type="text" class="form-control" id="nome_musica" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Autor</span>
            <input type="text" class="form-control" id="autor" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          </div>
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Versão</span>
            <input type="text" class="form-control" id="versao" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault1">
            <label class="form-check-label" for="radioDefault1">
              Simplificada
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2" checked>
            <label class="form-check-label" for="radioDefault2">
              Padrão
            </label>
          </div>
          <br>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="upload_cifra">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" onclick="enviarCifra()">Enviar</button>
        </div>
      </div>
    </div>
  </div>

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