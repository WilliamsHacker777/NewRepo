<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../services/HabitacionService.php";
require_once __DIR__ . "/../core/Database.php";

class HomeController extends Controller {

    public function index()
    {
        $habitacionService = new HabitacionService();
        $habitaciones = $habitacionService->listarDisponibles();

        $this->render("home/index", [
            "habitaciones" => $habitaciones,
            "logueado" => isset($_SESSION['user']) ? $_SESSION['user'] : null
        ]);
    }
}
