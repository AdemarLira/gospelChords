<?php
    if ($_SESSION['tipo_usuario'] != 'admin') {
        header("Location: ../index.php");
    exit();
	}
