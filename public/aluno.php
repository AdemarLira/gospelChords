<?php

session_start();

require_once __DIR__ . '/../app/config/config.php';

require_once __DIR__ . '/../app/middleware/Auth.php';
require_once __DIR__ . '/../app/middleware/Aluno.php';

require_once __DIR__ . '/../app/views/aluno/dashboard.php';