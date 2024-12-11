<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $password = $_POST['password'];

    if (empty($dni) || empty($password)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    $query = "SELECT id_admin FROM administrador WHERE dni = '$dni' AND contraseña = '$password'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        $_SESSION['id_admin'] = $admin['id_admin']; 
        header("Location: adminIndex.php"); 
        exit;
    } else {
        echo "DNI o contraseña incorrectos.";
    }

    $mysqli->close();
} else {
    echo "Método no permitido.";
}
?>