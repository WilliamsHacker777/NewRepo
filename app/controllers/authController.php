<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../services/AuthService.php";
require_once __DIR__ . "/../core/Database.php";

class AuthController extends Controller {

    public function loginView()
    {
        $this->render("auth/login");
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Método no permitido";
            return;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $conn = Database::getInstance();
        $auth = new AuthService($conn);

        if ($auth->login($email, $password)) {
            header("Location: /home");
            exit;
        }

        $this->render("auth/login", [
            "error" => "Credenciales incorrectas"
        ]);
    }
}
