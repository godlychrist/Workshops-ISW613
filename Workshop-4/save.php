<?php
// save.php
require_once 'User.php'; 
require_once 'Database.php';
require_once 'UserRepository.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Recoger datos
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $provincia = $_POST['provincia'];

    // 2. Crear Objeto User (Modelo)
    $newUser = new User($username, $password, $nombre, $apellidos, $provincia);

    // 3. Inicializar Repositorio (Capa de Datos)
    $database = new Database();
    $userRepository = new UserRepository($database);

    // 4. Guardar
    if ($userRepository->save($newUser)) {
        header("Location: login.php?user=" . urlencode($username));
        exit();
    } else {
        echo "Error al registrar el usuario. Por favor, intente de nuevo.";
    }
}
// El objeto $database se destruye aquí, cerrando la conexión.
?>