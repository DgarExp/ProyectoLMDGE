<?php
require 'conexion.php'; // Conexión a la base de datos
session_start(); // Iniciar sesión

$error = ''; 
$success = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? ''; 
    $email = $_POST['email'] ?? ''; 
    $telefono = $_POST['telefono'] ?? ''; 

    // Verificar que los campos no estén vacíos
    if (!empty($nombre) && !empty($email) && !empty($telefono)) {
        $query = "INSERT INTO entrenador (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";
        if ($mysqli->query($query)) {
            $success = 'Entrenador registrado con éxito.';
        } else {
            $error = 'Hubo un error al registrar al entrenador.';
        }
    } else {
        $error = 'Por favor, completa todos los campos.';
    }
}

?>
