<?php
$totalCursos = $conn->query
		("SELECT COUNT(*) total FROM cursos")->fetch_assoc()['total'];