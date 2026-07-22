<?php

#include_once("../api/conexao.php");

require_once __DIR__ . '/../../app/config/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include("includes/header_aluno.php");

include("includes/menu_aluno.php");
include("includes/modals.php");

?>
  
  

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