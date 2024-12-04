<?php
// db.php
$host = 'localhost'; // Servidor de base de datos
$db = 'titulacionyegresados'; // Nombre de la base de datos
$user = 'root'; // Usuario de MySQL (ajusta si es diferente)
$pass = ''; // Contraseña de MySQL (ajusta si es diferente)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>





