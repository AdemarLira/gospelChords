<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard_adm.php">
      <img src="assets/img/logo_amarela.png" height="40">
    </a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard_adm.php"> Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="alunos.php">Alunos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cursos.php">Cursos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="modulos.php">Módulos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aulas.php">Aulas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cifras.php">Cifras</a>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="financeiro.php">Financeiro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="relatorios.php">Relatórios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="configuracoes.php">Configurações</a>
          </li>
      </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"> 
              <img src="<?= htmlspecialchars($imagemPerfil); ?>" class="rounded-circle" width="40" height="40"></a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="meu_perfil.php">Meu Perfil</a>
          </li>
            <li>
              <a class="dropdown-item text-danger"href="../api/logout.php"> Sair</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>