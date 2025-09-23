<?php
// Incluir el archivo de conexión a la base de datos
include('connection.php');

// Verificar si los datos fueron enviados por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los valores del formulario
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, correo, telefono) 
            VALUES ('$first_name', '$last_name', '$email', '$phone')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente<br><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Mostrar los datos ingresados
    echo "<h3>Datos ingresados:</h3>";
    echo "Nombre: $first_name <br>";
    echo "Apellido: $last_name <br>";
    echo "Correo: $email <br>";
    echo "Teléfono: $phone <br><br>";
}

// Mostrar todos los registros de la base de datos
echo "<h3>Registros en la base de datos:</h3>";

$sql_select = "SELECT * FROM usuarios";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Mostrar los registros
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. " " . $row["apellido"]. " - Correo: " . $row["correo"]. " - Teléfono: " . $row["telefono"]. "<br>";
    }
} else {
    echo "No hay registros";
}

// Cerrar la conexión
$conn->close();
?>
