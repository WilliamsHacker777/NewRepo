<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../services/HabitacionService.php";
require_once __DIR__ . "/../core/Database.php";

class HabitacionController extends Controller {

    public function index()
    {
        $conn = Database::getInstance();
        $habitacionService = new HabitacionService($conn);
        $habitaciones = $habitacionService->listarDisponibles();

        $this->render("habitaciones/index", [
            "habitaciones" => $habitaciones
        ]);
    }
}
