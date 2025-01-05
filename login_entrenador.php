<?php
require 'conexion.php'; 
session_start();

$error = ''; 
$email = $_POST['email'] ?? ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($email)) {

    $query = "SELECT email, nombre FROM entrenador WHERE email = '$email'";
    $resultado = $mysqli->query($query);

    if ($resultado && $resultado->num_rows > 0) {

        $row = $resultado->fetch_assoc();
        $nombreEntrenador = $row['nombre'];

        $_SESSION['email'] = $email;
        $_SESSION['nombre'] = $nombreEntrenador;

        header('Location: indexEntrenador.php');
        exit;
    } else {
        $_SESSION['error'] = 'El correo no está registrado.';
        header('Location: login_entrenador2.php'); 
        exit;
    }
}
?>
