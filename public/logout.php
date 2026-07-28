<?php

require_once __DIR__ . '/../app/config/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];

session_unset();
session_destroy();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

header("Location: " . BASE_URL . "/index.php?erro=logout");
exit;