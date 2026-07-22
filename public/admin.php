<?php

session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';

require_once __DIR__ . '/../app/middleware/Auth.php';
require_once __DIR__ . '/../app/middleware/Admin.php';

require_once __DIR__ . '/../app/controllers/DashboardController.php';

$controller = new DashboardController($conn);

$dados = $controller->index();

require_once __DIR__ . '/../app/views/admin/dashboard.php';