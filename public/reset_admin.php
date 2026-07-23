<?php

require_once __DIR__ . '/../app/config/database.php';

$email = 'admin@teste.com';
$senha = '12345678';

$senhaHash = password_hash(
    $senha,
    PASSWORD_DEFAULT
);

$stmt = $conn->prepare(
    "UPDATE usuarios
     SET senha = ?, status = 'ativo', tipo_usuario = 'admin'
     WHERE email = ?"
);

$stmt->bind_param(
    "ss",
    $senhaHash,
    $email
);

if ($stmt->execute()) {

    echo '<h2>Senha atualizada com sucesso!</h2>';
    echo '<p>E-mail: admin@teste.com</p>';
    echo '<p>Senha: 12345678</p>';
    echo '<p>Linhas alteradas: ' . $stmt->affected_rows . '</p>';

} else {

    echo 'Erro: ' . $stmt->error;
}