<?php

session_start();

require_once __DIR__ . '/../app/config/config.php';

require_once __DIR__ . '/../app/middleware/Auth.php';

require_once __DIR__ . '/../app/middleware/Assinante.php';

require_once __DIR__ . '/../app/views/assinante/dashboard.php';