<?php

class Database {
    private $conn;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'workshop3';

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("La conexión falló: " . $this->conn->connect_error);
        }
    }

    // Método para obtener la conexión
    public function getConnection() {
        return $this->conn;
    }

    // Método para cerrar la conexión (opcional, pero buena práctica)
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>