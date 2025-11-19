<?php

require_once __DIR__ . '/../DAO/ReservaDAO.php';
require_once __DIR__ . '/../DAO/HabitacionDAO.php';
require_once __DIR__ . '/../entities/Reserva.php';

class ReservaService {

    private $reservaDAO;
    private $habitacionDAO;

    public function __construct($conn) {
        $this->reservaDAO = new ReservaDAO($conn);
        $this->habitacionDAO = new HabitacionDAO($conn);
    }

    public function verificarDisponibilidad($habitacionId, $inicio, $fin) {
        return !$this->reservaDAO->existeReservaEnRango($habitacionId, $inicio, $fin);
    }

    public function calcularTotal($habitacionId, $inicio, $fin) {
        $habitacion = $this->habitacionDAO->findAll();
        
        foreach ($habitacion as $h) {
            if ($h->id == $habitacionId) {
                $precio = $h->precio;
                break;
            }
        }

        $dias = (strtotime($fin) - strtotime($inicio)) / 86400;

        return $dias * $precio;
    }

    public function crearReserva($personaId, $habitacionId, $inicio, $fin) {
        if (!$this->verificarDisponibilidad($habitacionId, $inicio, $fin)) {
            return [
                "success" => false,
                "message" => "La habitación no está disponible en ese rango."
            ];
        }

        $total = $this->calcularTotal($habitacionId, $inicio, $fin);

        $reserva = new Reserva();
        $reserva->persona_id = $personaId;
        $reserva->habitacion_id = $habitacionId;
        $reserva->fecha_inicio = $inicio;
        $reserva->fecha_fin = $fin;
        $reserva->total = $total;
        $reserva->estado = "pendiente";

        $this->reservaDAO->create($reserva);

        return [
            "success" => true,
            "message" => "Reserva registrada correctamente.",
            "total" => $total
        ];
    }
}
