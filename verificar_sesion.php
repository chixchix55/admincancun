<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == true) {
  // Redirigir al usuario al archivo 'admin.html'
  header('Location: admin/admin.html');
  exit;
} else {
  // Si el usuario no está autenticado, redirigirlo al formulario de login
  header('Location: index.html');
  exit;
}
?>
