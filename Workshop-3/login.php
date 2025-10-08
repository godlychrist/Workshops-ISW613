<?php
$usuario_precargado = $_REQUEST['user'] ?? '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="validate.php" method="post">
        
        <label for="username">Usuario:</label>
        <input 
            type="text" 
            id="username" 
            name="username" 
            required
            value="<?php echo htmlspecialchars($usuario_precargado); ?>" 
        ><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>