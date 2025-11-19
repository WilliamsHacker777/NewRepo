<?php

class Database {

    private static $instance = null;
    private $conn;

    private $host = "MYSQL9001.site4now.net";
    private $db   = "db_ac1074_sistema";
    private $user = "ac1074_sistema";
    private $pass = "SNQqXqxx62X-mEJ";
    private $charset = "utf8mb4";

    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            
            $this->conn = new PDO($dsn, $this->user, $this->pass);

            // Configuración recomendada
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error conexión MySQL: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new Database();

        return self::$instance->conn;
    }
}
