<?php

function obterImagemPerfil(): string
{
    return !empty($_SESSION['img'])
        ? $_SESSION['img']
        : 'assets/img/avatar.png';
}