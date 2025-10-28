<?php
/**
 * validateActiveSessions.php
 *
 * Uso (CLI):
 *    php validateActiveSessions.php 24
 * Marca como 'inactive' a los usuarios cuyo último login fue hace más de N horas.
 */

if (php_sapi_name() !== 'cli') {
  echo "Ejecuta este script desde la línea de comandos.\n";
  exit(1);
}

$hours = isset($argv[1]) ? (int)$argv[1] : 24;
if ($hours <= 0) {
  echo "Uso: php validateActiveSessions.php <horas>\n";
  exit(1);
}

require_once __DIR__ . '/functions.php';
$conn = getConnection();

// Desactivar usuarios activos cuyo last_login_datetime sea nulo o anterior al umbral
$sql = "UPDATE users
        SET status = 'inactive'
        WHERE status = 'active'
          AND (last_login_datetime IS NULL OR last_login_datetime < (NOW() - INTERVAL ? HOUR))";

$stmt = $conn->prepare($sql);
if (!$stmt) {
  echo "Error preparando la consulta: " . $conn->error . PHP_EOL;
  $conn->close();
  exit(1);
}

$stmt->bind_param("i", $hours);
$stmt->execute();
if ($conn->errno) {
  echo "Error al ejecutar: " . $conn->error . PHP_EOL;
  $stmt->close();
  $conn->close();
  exit(1);
}

$affected = $conn->affected_rows;
$stmt->close();
$conn->close();

echo "Usuarios desactivados: $affected (umbral: $hours horas)\n";