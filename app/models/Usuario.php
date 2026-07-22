	<?php
    $totalAlunos = $conn->query
	("SELECT COUNT(*) total FROM usuarios WHERE tipo_cadastro='aluno'")->fetch_assoc()['total'];

    $totalAssinantes = $conn->query
		("SELECT COUNT(*) total FROM usuarios WHERE tipo_cadastro='assinante'")->fetch_assoc()['total'];