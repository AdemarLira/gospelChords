<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Recuperar senha - Gospel Chords</title>

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
        loop
        autoplay
        muted
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
            Recuperar senha
        </h3>

        <p class="text-muted text-center">
            Informe seu e-mail para receber
            o link de redefinição da senha.
        </p>

        <form
            action="<?= BASE_URL ?>/api/auth/recuperar_senha.php"
            method="POST"
        >

            <div class="mb-3">

                <label
                    for="email"
                    class="form-label"
                >
                    E-mail
                </label>

                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    required
                >

            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
            >
                Enviar link de recuperação
            </button>

        </form>

        <div class="text-center mt-3">

            <a href="<?= BASE_URL ?>/index.php">
                Voltar ao login
            </a>

        </div>

    </div>

</div>

</body>

</html>