<?php
// Incluir el archivo de conexión a la base de datos
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los valores del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $provincia = $_POST['provincia'];

    $sql = "INSERT INTO usuarios (username, password, nombre, apellidos, provincia) 
            VALUES ('$username', '$password', '$nombre', '$apellidos', '$provincia')";

if ($conn->query($sql) === TRUE) {
    // 4. Redirección con el nombre de usuario
    // Creamos un parámetro 'user' en la URL con el valor del username registrado.
    header("Location: login.php?user=" . urlencode($username));
    exit(); // Es crucial llamar a exit() después de header()
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}
}

$conn->close();
?>
