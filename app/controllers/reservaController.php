<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../services/ReservaService.php";
require_once __DIR__ . "/../services/ReniecService.php";
require_once __DIR__ . "/../DAO/PersonaDAO.php";
require_once __DIR__ . "/../core/Database.php";
require_once __DIR__ . "/../services/ReniecService.php";


class ReservaController extends Controller {

    // Mostrar formulario de reserva
    public function reservar()
{
    if (!isset($_SESSION['user'])) {
        header("Location: /ProyectoReservas/public/login");
        exit;
    }

    $habitacionId = $_GET['id'] ?? null;

    if (!$habitacionId) {
        echo "Habitación no encontrada";
        return;
    }

    $habitacionService = new HabitacionService();
    $habitacion = $habitacionService->buscarPorId($habitacionId);

    $this->render("reservas/reservar", [
        "habitacion" => $habitacion
    ]);
}


    // Procesar reserva (POST)
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Método no permitido";
            return;
        }

        $dni = $_POST['dni'];
        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];
        $habitacionId = $_POST['habitacion_id'];

        $conn = Database::getInstance();

        // ----- VALIDAR DNI -----
        $reniecService = new ReniecService();
        $dniInfo = $reniecService->validarDni($dni);

        if (!$dniInfo) {
            $this->render("reservas/error", [
                "mensaje" => "DNI inválido o no encontrado."
            ]);
            return;
        }

        // ----- Registrar persona si no existe -----
        $personaDAO = new PersonaDAO($conn);
        $persona = $personaDAO->findByDni($dni);

        if (!$persona) {
            $p = new Persona();
            $p->dni = $dni;
            $p->nombres = $dniInfo["nombres"];
            $p->apellidos = $dniInfo["apellidos"];
            $p->telefono = null;
            $p->email = null;

            $personaDAO->create($p);
            $persona = $personaDAO->findByDni($dni);
        }

        // ----- LÓGICA DE RESERVA -----
        $reservaService = new ReservaService($conn);
        $resultado = $reservaService->crearReserva($persona->id, $habitacionId, $inicio, $fin);

        if (!$resultado["success"]) {
            $this->render("reservas/error", [
                "mensaje" => $resultado["message"]
            ]);
            return;
        }

        // ----- Mostrar confirmación -----
        $this->render("reservas/confirmar", [
            "total" => $resultado["total"],
            "inicio" => $inicio,
            "fin" => $fin
        ]);
    }
}
