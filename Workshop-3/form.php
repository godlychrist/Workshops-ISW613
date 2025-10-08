<?php
include_once 'connection.php'; 
include_once 'functions.php';

$provincias = obtenerProvincias();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>


<body>
    <h1>Register</h1>
    <form action="save.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="password">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="password">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required><br><br>
        <label for="provincias">Provincias:</label>
        <select name="provincia" id="provincia" required>
            <option value="">Seleccione una provincia</option>
            <?php foreach ($provincias as $prov) { ?>
            <option value="<?php echo htmlspecialchars($prov['provincias']); ?>">
                <?php echo htmlspecialchars($prov['provincias']); ?>
            </option>
            <?php } ?>
        </select>
        <br><br>
        <button type="submit">Register</button>
    </form>

    <a href="print.php?username=admin&password=22345">View</a>
</body>

</html>