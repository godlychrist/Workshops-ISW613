<?php
// Datos de la conexión
$host = 'localhost'; // O la dirección de tu servidor de base de datos
$username = 'root';  // Nombre de usuario
$password = '';      // Contraseña de MySQL (vacío por defecto en XAMPP)
$database = 'workshop3'; // Nombre de la base de datos

// Crear la conexión usando MySQLi
$conn = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// No cerramos la conexión aquí, porque otros archivos pueden usarla.
?>
