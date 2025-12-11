<?php

require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../services/habitacionService.php";
require_once __DIR__ . "/../core/dataBase.php";

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
