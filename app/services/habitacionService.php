<?php

require_once __DIR__ . "/../DAO/habitacionDAO.php";

class HabitacionService {

    private $dao;

    public function __construct()
    {
        // La conexión la obtiene aquí
        $conn = Database::getInstance();
        $this->dao = new HabitacionDAO($conn);
    }

    public function listarDisponibles()
    {
        return $this->dao->findAll();
    }

    public function buscarPorId($id)
    {
        return $this->dao->findById($id);
    }
}
