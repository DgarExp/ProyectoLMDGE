<?php
require 'conexion.php';

$message = ''; // Variable para el mensaje de éxito o error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_clase = $_POST['nombre_clase'];
    $capacidad = (int) $_POST['capacidad'];
    $id_entrenador = (int) $_POST['id_entrenador'];
    $dia_semana = $_POST['dia_semana'];
    $hora = $_POST['hora'];

    // Insertar clase en la base de datos
    $query_clase = "INSERT INTO clase (nombre_clase, capacidad, id_entrenador, inscritos) VALUES ('$nombre_clase', $capacidad, $id_entrenador, 0)";
    $result_clase = $mysqli->query($query_clase);

    if ($result_clase) {
        // Obtener el ID de la clase recién insertada
        $id_clase = $mysqli->insert_id; 

        // Insertar intervalo (hora y día) de la clase
        $query_intervalo = "INSERT INTO intervalo (id_clase, dia_semana, hora) VALUES ($id_clase, '$dia_semana', '$hora')";
        $result_intervalo = $mysqli->query($query_intervalo);

        // Establecer el mensaje de éxito
        if ($result_intervalo) {
            $message = 'Clase añadida con éxito.';
        } else {
            $message = 'Error al añadir el horario de la clase.';
        }
    } else {
        $message = 'Error al añadir la clase.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
    <title>Resultado - GymShark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #333;
            color: #ddd;
        }
        .alert-custom {
            background-color: #555; /* Gris más suave en lugar de negro */
            color: #fff;
            border-color: #ccc;
        }
        .btn-custom {
            background-color: #dc3545;
            color: white;
        }
        .btn-custom:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Mostrar mensaje de éxito o error -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-custom text-center">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Botón para volver al formulario -->
        <div class="text-center">
            <a href="crear_clase.html" class="btn btn-custom btn-lg">Volver al formulario</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
