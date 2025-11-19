<?php

require_once __DIR__ . "/../entities/Usuario.php";

class UsuarioDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function findByEmail($email) {

        $sql = "SELECT * FROM usuarios WHERE email = ? AND activo = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $u = new Usuario();
            $u->id       = $row['id'];
            $u->email    = $row['email'];
            $u->password = $row['password'];
            $u->rol      = $row['rol'];
            $u->activo   = $row['activo'];
            return $u;
        }

        return null;
    }

    public function create(Usuario $usuario) {

        $sql = "INSERT INTO usuarios (email, password, rol, activo)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $usuario->email,
            $usuario->password,  // -> debe llegar con password_hash()
            $usuario->rol,
            $usuario->activo
        ]);
    }

       public function update(Usuario $usuario) {

        $sql = "UPDATE usuarios
                SET email = ?, rol = ?, activo = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $usuario->email,
            $usuario->rol,
            $usuario->activo,
            $usuario->id
        ]);
    }

       public function updatePassword($id, $newPassword) {

        $sql = "UPDATE usuarios SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $newPassword, // debe venir con password_hash()
            $id
        ]);
    }
}
