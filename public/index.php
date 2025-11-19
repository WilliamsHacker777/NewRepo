<?php
session_start();
require_once __DIR__ . '/../app/core/Router.php';
Router::handle();
