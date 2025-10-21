<?php
// UserRepository.php - Lógica de BBDD para Usuarios y datos relacionados
require_once 'Database.php';
require_once 'User.php'; 

class UserRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function save(User $user) {
        $conn = $this->db->getConnection();
        
        $sql = "INSERT INTO usuarios (username, password, nombre, apellidos, provincia) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
             error_log("Error al preparar la sentencia: " . $conn->error);
             return false;
        }

        $stmt->bind_param("sssss", 
            $user->getUsername(), 
            $user->getPassword(), 
            $user->getNombre(), 
            $user->getApellidos(), 
            $user->getProvincia()
        );

        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }
    
    // Método que reemplaza obtenerProvincias()
    public function obtenerProvincias() {
        $conn = $this->db->getConnection();
        $sql = 'SELECT provincias FROM provincias'; 
        $resultado = $conn->query($sql);
        
        if (!$resultado) {
            error_log("ERROR EN CONSULTA: Error SQL en la tabla provincias: " . $conn->error);
            return [];
        }
        
        $provincias = [];
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $provincias[] = $fila; 
            }
        }
        return $provincias;
    }
}
?>