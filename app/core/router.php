<?php

require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/ReservaController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/HabitacionController.php';

class Router {

    public static function handle()
    {
        // Obtener ruta (si no trae nada, es home)
        $url = $_GET['url'] ?? '';

        switch ($url) {

            // ---------- HOME ----------
            case '':
            case 'home':
                (new HomeController())->index();
                break;

            // ---------- HABITACIONES ----------
            case 'habitaciones':
                (new HabitacionController())->index();
                break;

            // ---------- FORMULARIO DE RESERVA ----------
            case 'reservar':
                (new ReservaController())->reservar();
                break;

            // ---------- GUARDAR RESERVA (POST) ----------
            case 'reservar/guardar':
                (new ReservaController())->guardar();
                break;

            // ---------- LOGIN ----------
            case 'login':
                (new AuthController())->loginView();
                break;

            case 'login/process':
                (new AuthController())->process();
                break;

            // ---------- ERROR 404 ----------
            default:
                http_response_code(404);
                echo "<h1>404 - Página no encontrada</h1>";
        }
    }
}
