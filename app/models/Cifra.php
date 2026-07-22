<?php
$totalCifras = $conn->query
		("SELECT COUNT(*) total FROM cifras")->fetch_assoc()['total'];