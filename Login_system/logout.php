<?php
session_start(); // Iniciar la sesión
session_destroy(); // Destruir la sesión
header("Location: login.php"); // Redirigir al usuario a la página de inicio de sesión (o donde prefieras)
exit(); // Asegúrate de salir después de la redirección
?>

