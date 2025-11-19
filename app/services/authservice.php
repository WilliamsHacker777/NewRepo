<?php

require_once __DIR__ . '/../DAO/UsuarioDAO.php';

class AuthService {

    private $usuarioDAO;

    public function __construct($conn) {
        $this->usuarioDAO = new UsuarioDAO($conn);
    }

    public function login($email, $password) {

        $usuario = $this->usuarioDAO->findByEmail($email);

        if (!$usuario) {
            return false;
        }

        // password_hash y password_verify funcionan igual que en Laravel
        if (password_verify($password, $usuario->password)) {
            $_SESSION['user'] = $usuario;
            return true;
        }

        return false;
    }

    public function logout() {
        session_destroy();
    }

    public function user() {
        return $_SESSION['user'] ?? null;
    }

    public function check() {
        return isset($_SESSION['user']);
    }
}
