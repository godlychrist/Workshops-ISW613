<?php
// form.php
// Usamos las clases POO para obtener los datos
require_once 'Database.php';
require_once 'UserRepository.php';

$database = new Database();
$userRepository = new UserRepository($database);
$provincias = $userRepository->obtenerProvincias();

// No cerramos la conexión aquí, ya que el ciclo de vida del objeto $database
// se destruirá al final del script automáticamente si no lo cerramos manualmente.
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <form action="save.php" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required><br><br>
        <label for="provincia">Provincia:</label>
        <select name="provincia" id="provincia" required>
            <option value="">Seleccione una provincia</option>
            <?php foreach ($provincias as $prov) { ?>
                <option value="<?= htmlspecialchars($prov['provincias']) ?>">
                    <?= htmlspecialchars($prov['provincias']) ?>
                </option>
            <?php } ?>
        </select>
        <br><br>
        <button type="submit">Registrar</button>
    </form>

    <a href="login.php?username=admin&password=22345">Ver registros</a>
</body>
</html>