<?php
// functions.php

function obtenerProvincias() {
    global $conn;

    // Usamos el SELECT que trae la única columna existente.
    $sql = 'SELECT provincias FROM provincias'; 
    $resultado = $conn->query($sql);

    // *** Código de Verificación ***
    if (!$resultado) {
        // Si la consulta falla (tabla mal nombrada, columna incorrecta, etc.)
        // verás este error.
        echo "ERROR EN CONSULTA: Error SQL en la tabla provincias: " . $conn->error;
        return [];
    }
    // *** Si llegas aquí, la consulta funciona, pero puede estar vacía.
    
    $provincias = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $provincias[] = $fila; 
        }
    }
    
    // *** Código de Verificación ***
    // Si ves este mensaje y el array está vacío (Array()), la tabla está vacía.
    // print_r($provincias); 
    
    return $provincias;
}
?>