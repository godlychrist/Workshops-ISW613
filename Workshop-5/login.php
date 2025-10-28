<?php
require('functions.php');

if($_POST) {
  $username = $_REQUEST['username'] ?? '';
  $password = $_REQUEST['password'] ?? '';

  $user = authenticate($username, $password);

  if (is_array($user) && isset($user['__error']) && $user['__error'] === 'inactive') {
    header('Location: index.php?status=inactive');
    exit;
  }

  if($user) {
    session_start();
    $_SESSION['user'] = $user;
    header('Location: dashboard.php');
    exit;
  } else {
    header('Location: index.php?status=login');
    exit;
  }
}