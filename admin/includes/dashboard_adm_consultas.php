
<?php
// Quantidade total de alunos
	$totalAlunos = $conn->query
	("SELECT COUNT(*) total FROM usuarios WHERE tipo_cadastro='aluno'")->fetch_assoc()['total'];

// Assinantes
	$totalAssinantes = $conn->query
		("SELECT COUNT(*) total FROM usuarios WHERE tipo_cadastro='assinante'")->fetch_assoc()['total'];

// Cursos
	$totalCursos = $conn->query
		("SELECT COUNT(*) total FROM cursos")->fetch_assoc()['total'];

// Cifras
	$totalCifras = $conn->query
		("SELECT COUNT(*) total FROM cifras")->fetch_assoc()['total'];

// tablaturas
	$totalTablaturas = $conn->query
		("SELECT COUNT(*) total FROM tablaturas")->fetch_assoc()['total'];

// Partituras
	$totalPartituras = $conn->query
		("SELECT COUNT(*) total FROM partituras")->fetch_assoc()['total'];

// Usuários ativos
	$totalAtivos = $conn->query
		("SELECT COUNT(*) AS total FROM usuarios WHERE status = 'ativo' AND tipo_usuario <> 'admin'")->fetch_assoc()['total'];

// Pendentes
	$totalPendentes = $conn->query
		("SELECT COUNT(*) AS total FROM usuarios WHERE status = 'pendente' AND tipo_usuario <> 'admin'")->fetch_assoc()['total'];

?>
