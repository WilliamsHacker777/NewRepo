<?php

require_once __DIR__ . "/../entities/Persona.php";

class PersonaDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function findByDni($dni) {
        $sql = "SELECT * FROM personas WHERE dni = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$dni]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $persona = new Persona();
            $persona->id = $row['id'];
            $persona->dni = $row['dni'];
            $persona->nombres = $row['nombres'];
            $persona->apellidos = $row['apellidos'];
            $persona->telefono = $row['telefono'];
            $persona->email = $row['email'];
            return $persona;
        }
        return null;
    }

    public function create(Persona $persona) {
        $sql = "INSERT INTO personas (dni, nombres, apellidos, telefono, email)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $persona->dni,
            $persona->nombres,
            $persona->apellidos,
            $persona->telefono,
            $persona->email
        ]);
    }
}
