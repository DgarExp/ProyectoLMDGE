<?php
require 'conexion.php';
session_start();

$error = '';
$email = $_POST['email'] ?? '';

// Verificar si el formulario fue enviado y si el campo de email no está vacío
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($email)) {
    // Crear la consulta directamente
    $query = "SELECT email, nombre FROM entrenador WHERE email = '$email'";
    $resultado = $mysqli->query($query);

    // Verificar si el correo existe
    if ($resultado && $resultado->num_rows > 0) {
        // Obtener el nombre del entrenador
        $row = $resultado->fetch_assoc();
        $nombreEntrenador = $row['nombre'];

        // Guardar el correo y nombre en la sesión
        $_SESSION['email'] = $email;
        $_SESSION['nombre'] = $nombreEntrenador;

        // Redirigir a la página de bienvenida del entrenador
        header('Location: indexEntrenador.php');
        exit;
    } else {
        $error = 'El correo no está registrado.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
    <title>Login de Entrenador - GymShark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #333;
            color: #ddd;
        }
        .card {
            background-color: #444;
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .form-label {
            color: #ddd;
        }
        .form-control {
            background-color: #555;
            border: 1px solid #666;
            color: #fff;
        }
        .form-control:focus {
            background-color: #555;
            border-color: #777;
            box-shadow: none;
        }
        .boton-inicio {
            background-color: #28a745;
            border-color: #218838;
        }
        .boton-inicio:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .header-title {
            font-size: 40px; 
            font-weight: bold;
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }
        .alert-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        .boton-regresar {
            background-color: #6c757d;
            border-color: #5a6268;
        }
        .boton-regresar:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="header-title">Login</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <?= !empty($error) ? "<div class='alert alert-danger text-center'>$error</div>" : '' ?>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu email" required>
                            </div>
                            <button type="submit" class="btn boton-inicio w-100">Iniciar Sesión</button>
                        </form>
                        <a href="index.html" class="btn boton-regresar w-100 mt-3">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
