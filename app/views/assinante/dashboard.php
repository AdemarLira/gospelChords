<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=naoautorizado");
    exit();
}

?>
<!-- ==========================
        CONTEÚDO DA PÁGINA
=========================== -->

<!-- MODAL ENVIAR CIFRA -->

<div class="modal fade" id="modal-upload" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enviar Cifra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
                <!-- seus campos continuam aqui -->
           </div>
        </div>
    </div>
</div>

<!-- ASSINATURAS -->
<div id="assinaturas" class="container mt-4" style="display:none">
  <h2 class="mb-4">Assinaturas</h2>
    <div class="card">
      <div class="card-body">
        <h5>Plano Free</h5>
        <p>Recursos disponíveis:</p>
        <strong>R$0,00</strong>
    </div>
  </div>
</div>

<!-- LISTAS -->
  <div id="listas-musicas" class="container mt-4" style="display:none">
    <h2 class="txt-body">Minhas listas</h2>
      <div class="card">
        <div class="card-body">
          <h5>Nome da Lista</h5>
          <p>Autor:</p>
          <small>
          Versão: Simplificada
          </small>
        </div>
      </div>
    </div>

