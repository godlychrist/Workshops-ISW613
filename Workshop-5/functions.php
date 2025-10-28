<?php
/**
 *  Gets a new mysql connection
 */
function getConnection() {
  // Ajusta host/usuario/pass/db si lo ocupas
  $connection = new mysqli('localhost:3306', 'root', '', 'php_web2');
  if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $connection->connect_error);
    die;
  }
  // Opcional pero útil en desarrollo:
  $connection->set_charset('utf8mb4');
  return $connection;
}

/**
 * Autentica usuario. Solo permite status=active.
 * Actualiza last_login_datetime en login exitoso.
 *
 * Nota: sigue usando password en texto plano para ser compatible con tu semana 5.
 * Luego lo migramos a password_hash/password_verify si quieres.
 */
function authenticate($username, $password){
  $conn = getConnection();

  // Prepared Statement para evitar inyección
  $stmt = $conn->prepare("
    SELECT id, username, `password`, `name`, `lastname`, `email-address`, `role`, `status`, `last_login_datetime`
    FROM users
    WHERE `username` = ? AND `password` = ?
    LIMIT 1
  ");
  if (!$stmt) {
    $conn->close();
    return false;
  }

  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($conn->errno) {
    $stmt->close();
    $conn->close();
    return false;
  }

  $user = $result->fetch_assoc();
  $stmt->close();

  if (!$user) {
    $conn->close();
    return false; // usuario o pass incorrectos
  }

  // Validar que esté activo
  if (isset($user['status']) && $user['status'] !== 'active') {
    $conn->close();
    // Para que tu index.php pueda mostrar mensaje de inactivo:
    return ['__error' => 'inactive'];
  }

  // Actualizar last_login_datetime
  $upd = $conn->prepare("UPDATE users SET last_login_datetime = NOW() WHERE id = ?");
  if ($upd) {
    $upd->bind_param("i", $user['id']);
    $upd->execute();
    $upd->close();
    $user['last_login_datetime'] = date('Y-m-d H:i:s'); // reflejo en el array
  }

  $conn->close();
  return $user;
}

/**
 * Guarda estudiante
 */
function saveStudent($full_name, $email, $document = ''){
  $conn = getConnection();

  $stmt = $conn->prepare("INSERT INTO students (full_name, email, document) VALUES (?,?,?)");
  if (!$stmt) {
    $conn->close();
    return false;
  }
  $stmt->bind_param("sss", $full_name, $email, $document);
  $ok = $stmt->execute();
  $stmt->close();
  $conn->close();

  return $ok ? true : false;
}

/**
 * Obtiene todos los estudiantes (solo activos si agregaste status en students)
 * Si NO agregaste status en students, usa el SELECT simple sin WHERE.
 */
function getStudents(){
  $conn = getConnection();

  // Si NO tienes status en students:
  $sql = "SELECT * FROM students";

  // Si SÍ agregaste status en students:
  // $sql = "SELECT * FROM students WHERE status = 'active'";

  $result = $conn->query($sql);

  if ($conn->errno) {
    $conn->close();
    return [];
  }

  $data = [];
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }

  $conn->close();
  return $data;
}

/**
 * Elimina estudiante (o desactiva si agregaste status)
 */
function deleteStudent($id){
  $conn = getConnection();

  // Si NO tienes status en students y realmente quieres borrar:
  $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
  // Si SÍ agregaste status en students y prefieres soft-delete:
  // $stmt = $conn->prepare("UPDATE students SET status='inactive' WHERE id = ?");

  if (!$stmt) {
    $conn->close();
    return false;
  }

  $stmt->bind_param("i", $id);
  $ok = $stmt->execute();
  $stmt->close();
  $conn->close();

  return $ok ? true : false;
}