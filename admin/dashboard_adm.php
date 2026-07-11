<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SESSION['tipo_usuario'] != 'admin') {
    header("Location: ../dashboard.php");
    exit();
}
?>

<?php
  include_once("../api/conexao.php");
  session_start();
  
   if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=naoautorizado");
     exit();
   }

  $imagemPerfil = !empty($_SESSION['img'])
      ? $_SESSION['img']
      : 'assets/img/perfil/avatar.png';

include("../includes/header.php");
include("../includes/menu.php");
?>
    
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo_amarela.png">
    <script src="https://kit.fontawesome.com/328073035f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/dashboard_adm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <title>Página inicial</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
  </style>
</head>
<body>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/functions.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
      const checkbox = document.getElementById('checkbox');
      const body = document.body;

      checkbox.addEventListener('change', () => {
          if (checkbox.checked){
              body.classList.remove('light-mode');
              body.classList.add('dark-mode');
          } else{
              body.classList.remove('dark-mode');
              body.classList.add('light-mode');
          }
      });

    body.classList.add('light-mode');})


    // ALTERNACIA no conteudo do body
    function mostrarPainel(id) {
    const paineis = ['listas-musicas', 'assinaturas'];
    paineis.forEach(painel => {
      document.getElementById(painel).style.display = (painel === id) ? 'block' : 'none';
    });
  }

  function fecharPainel(id) {
    document.getElementById(id).style.display = 'none';
  }

  // Adiciona os listeners ao carregar o DOM
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btn-listas').addEventListener('click', (e) => {
      e.preventDefault();
      mostrarPainel('listas-musicas');
    });

    document.getElementById('btn-assinaturas').addEventListener('click', (e) => {
      e.preventDefault();
      mostrarPainel('assinaturas');
    });
  });
</script>
</body>
</html>
<?php
include("../includes/footer.php");
?>