<?php

$totalTablaturas = $conn->query
		("SELECT COUNT(*) total FROM tablaturas")->fetch_assoc()['total'];