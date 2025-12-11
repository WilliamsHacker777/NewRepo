<?php
// api/index.php - Vercel Entry Point
session_start();

// Adjust path to reach app/core/router.php from api/
require_once __DIR__ . '/../app/core/router.php';

$router = new Router();
$router->handle();
