<?php
// Incluir archivo de conexión
require 'db.php';
session_start();

// Variable para el mensaje
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanear datos de entrada
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $password = trim($_POST['password']);

    // Consulta preparada para evitar inyecciones SQL
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
        // Regenerar ID de sesión para evitar fijación de sesión
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        // Redirigir a otra página
        header("Location: ../Principal.php");
        exit(); // Siempre incluir exit después de header para evitar que el script continúe ejecutándose
    } else {
        // Asignar mensaje de error
        $message = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="Styles.css" type="text/css">
</head>

<body>

<!-- Mensaje flotante -->
<?php if ($message): ?>
    <div class="floating-message">
        <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
<?php endif; ?>

<!-- Formulario de inicio de sesión -->
<form method="POST" action="login.php">
    <h1>TITULACION Y EGRESADOS</h1>

    <input type="text" name="username" placeholder="Nombre de usuario" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br><br>
    <button type="submit">Iniciar sesión</button><br><br>

    <a href="register.php" style="color: white;">Registrar usuario</a>

</form>

</body>
</html>
