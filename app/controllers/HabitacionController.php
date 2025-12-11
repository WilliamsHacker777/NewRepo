<?php

require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../services/habitacionService.php";
require_once __DIR__ . "/../core/dataBase.php";

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
