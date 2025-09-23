<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1> Fecha y Hora de Costa Rica </h1>
    <?php
        date_default_timezone_set("America/Costa_Rica");
        echo "Fecha: " . date("d/m/Y") . "<br>";
        echo "Hora: " . date("h:i:sa");
        ?>x
</body>
</html>