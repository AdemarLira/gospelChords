<?php
require_once("../api/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
   $celular = preg_replace('/\D/', '', $_POST['celular']);
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $status = $_POST['status'];

    $sql = "UPDATE usuarios
            SET nome=?,
                email=?,
                celular=?,
                cidade=?,
                estado=?,
                status=?
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssi",
        $nome,
        $email,
        $celular,
        $cidade,
        $estado,
        $status,
        $id
    );

    if($stmt->execute()){
        header("Location: usuarios.php?sucesso=1");
    }else{
        echo "Erro ao atualizar.";
    }

}
?>