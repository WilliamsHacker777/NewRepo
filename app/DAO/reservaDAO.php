<?php

require_once __DIR__ . "/../entities/Reserva.php";

class ReservaDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function existeReservaEnRango($habitacionId, $inicio, $fin) {
        $sql = "SELECT COUNT(*) as total
                FROM reservas
                WHERE habitacion_id = ?
                AND (fecha_inicio <= ? AND fecha_fin >= ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$habitacionId, $fin, $inicio]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'] > 0;
    }

    public function create(Reserva $reserva) {
        $sql = "INSERT INTO reservas (persona_id, habitacion_id, fecha_inicio, fecha_fin, total, estado)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $reserva->persona_id,
            $reserva->habitacion_id,
            $reserva->fecha_inicio,
            $reserva->fecha_fin,
            $reserva->total,
            $reserva->estado
        ]);
    }
}
