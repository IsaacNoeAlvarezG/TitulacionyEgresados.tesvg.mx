<?php
// Incluir archivo de conexión
require 'db.php';
$message = ''; // Variable para el mensaje
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->execute([':username' => $username, ':email' => $email, ':password' => $password]);

    // Cambiar el mensaje a uno que se mostrará en un mensaje flotante
    $message = "Usuario registrado con éxito";
}
?>
<html>
<head>
    <link rel="stylesheet" href="Styles.css" type="text/css">
</head>
<!-- Formulario de registro -->
<body>

    <!-- Mensaje flotante -->
<?php if ($message): ?>
    <div class="floating-message">
        <p><?php echo $message; ?></p>
    </div>
<?php endif; ?>

<!-- Formulario de registro -->
    <form method="POST" action="register.php">
        <h1>REGISTRAR USUARIO</h1>
        <input type="text" name="username" placeholder="Nombre de usuario" required><br>
        <input type="text" name="email" placeholder="Correo electrónico" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
