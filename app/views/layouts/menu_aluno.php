<?php

if (!defined('BASE_URL')) {
    require_once __DIR__ . '/../../config/config.php';
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$imagemPerfil = !empty($_SESSION['img'])
    ? '/assets/img/perfil/' . $_SESSION['img']
    : '/assets/img/perfil/avatar.png';

?>

<nav class="navbar navbar-expand-lg custom-navbar" id="painel-navegacao">
    <div class="container-fluid">

        <a class="navbar-brand" href="dashboard_aluno.php">
            <img src="<?= BASE_URL ?>/assets/img/logo_azul.png"
                 height="40"
                 alt="Logo Gospel Chords">
        </a>

        <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <div class="theme-switch-wrapper me-3">
                <label class="theme-switch">
                    <input type="checkbox" id="checkbox">
                    <div class="slider round"></div>
                </label>
            </div>

            <form class="d-flex me-auto" id="pesquisa-musica">
                <input
                    class="form-control me-2"
                    placeholder="Pesquisar música"
                >

                <button class="btn btn-outline-success" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <button
                class="btn btn-outline-secondary me-3"
                data-bs-toggle="modal"
                data-bs-target="#modalEnviarCifra">

                <i class="fas fa-upload me-1"></i>
                Enviar Cifra

            </button>

            <button
                class="btn"
                id="header-botao-premium"
                onclick="verificarPlanos()">

                Premium
                <i class="bi bi-bookmark-star-fill"></i>

            </button>

            <ul class="navbar-nav align-items-center">

                <li class="nav-item me-3">
                    <a href="#" id="btn-listas" class="nav-link">
                        Minhas listas
                    </a>
                </li>

                <li class="nav-item dropdown">

                    <a
                        class="perfil-btn dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                        <img
                            src="<?= htmlspecialchars($imagemPerfil) ?>"
                            class="foto-perfil"
                            alt="Perfil"
                        >

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow">

                        <li>
                            <a class="dropdown-item" href="meu_perfil.php">
                                <i class="bi bi-person"></i>
                                Meu perfil
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-star"></i>
                                Minhas assinaturas
                            </a>
                        </li>

                        <li>
                            <a
                                class="dropdown-item"
                                target="_blank"
                                href="https://wa.me/83998603238">

                                <i class="bi bi-whatsapp"></i>
                                Pedir cifra

                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a
                                class="dropdown-item text-danger"
                                href="../api/auth/logout.php">

                                <i class="bi bi-box-arrow-right"></i>
                                Sair

                            </a>
                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>
</nav>