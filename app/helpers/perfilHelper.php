<?php

function obterImagemPerfil(): string
{
    $avatar = BASE_URL . '/assets/img/perfil/avatar.png';

    if (
        !empty($_SESSION['img']) &&
        file_exists(__DIR__ . '/../../public/assets/img/perfil/' . $_SESSION['img'])
    ) {
        return BASE_URL . '/assets/img/perfil/' . $_SESSION['img'];
    }

    return $avatar;
}