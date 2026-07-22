<?php

$token = $_GET['token'] ?? '';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Redefinir senha - Gospel Chords</title>

    <link
        rel="icon"
        type="image/x-icon"
        href="<?= BASE_URL ?>/assets/img/logo.png"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/esqueci_senha.css"
    >

</head>

<body>

<div id="background">

    <video
        autoplay
        muted
        loop
    >

        <source
            src="<?= BASE_URL ?>/assets/mp4/violao.mp4"
            type="video/mp4"
        >

    </video>

</div>

<div class="container vh-100 d-flex justify-content-center align-items-center">

    <div
        class="card shadow p-4"
        style="max-width:450px;width:100%;"
    >

        <h3 class="text-center mb-4">
            Nova senha
        </h3>

        <form
            action="<?= BASE_URL ?>/api/auth/resetar_senha.php"
            method="POST"
        >

            <input
                type="hidden"
                name="token"
                value="<?= htmlspecialchars($token) ?>"
            >

            <div class="mb-3">

                <label
                    for="senha"
                    class="form-label"
                >
                    Nova senha
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="senha"
                    name="senha"
                    minlength="8"
                    required
                >

            </div>

            <div class="mb-3">

                <label
                    for="confirmar"
                    class="form-label"
                >
                    Confirmar senha
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="confirmar"
                    name="confirmar"
                    minlength="8"
                    required
                >

                <div
                    id="mensagemSenha"
                    class="text-danger mt-2"
                ></div>

            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
                id="btnAtualizar"
            >
                Atualizar senha
            </button>

        </form>

    </div>

</div>

<script>

const senha =
    document.getElementById('senha');

const confirmar =
    document.getElementById('confirmar');

const mensagem =
    document.getElementById('mensagemSenha');

const botao =
    document.getElementById('btnAtualizar');

function validarSenhas() {

    if (
        confirmar.value !== ''
        &&
        senha.value !== confirmar.value
    ) {

        mensagem.textContent =
            'As senhas não coincidem.';

        botao.disabled = true;

    } else {

        mensagem.textContent = '';

        botao.disabled = false;

    }

}

senha.addEventListener(
    'input',
    validarSenhas
);

confirmar.addEventListener(
    'input',
    validarSenhas
);

</script>

</body>

</html>