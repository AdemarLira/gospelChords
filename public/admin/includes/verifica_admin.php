<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }   

	if (!isset($_SESSION['usuario_id'])) {
        header("Location: ../index.php");
    exit();
	}	

	if ($_SESSION['tipo_usuario'] != 'admin') {
        header("Location: ../index.php");
    exit();
	}


