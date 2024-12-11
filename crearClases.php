<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_clase = $_POST['nombre_clase'];
    $capacidad = (int) $_POST['capacidad'];
    $id_entrenador = (int) $_POST['id_entrenador'];
    $dia_semana = $_POST['dia_semana'];
    $hora = $_POST['hora'];

    $query_clase = "INSERT INTO clase (nombre_clase, capacidad, id_entrenador, inscritos) VALUES ('$nombre_clase', $capacidad, $id_entrenador, 0)";
    $result_clase = $mysqli->query($query_clase);

    if ($result_clase) {
        $id_clase = $mysqli->insert_id; 

        $query_intervalo = "INSERT INTO intervalo (id_clase, dia_semana, hora) VALUES ($id_clase, '$dia_semana', '$hora')";
        $result_intervalo = $mysqli->query($query_intervalo);

        if ($result_intervalo) {
            echo '<div class="alert alert-success text-center">Clase añadida con éxito.</div>';
        } else {
            echo '<div class="alert alert-danger text-center">Error al añadir el horario de la clase.</div>';
        }
    } else {
        echo '<div class="alert alert-danger text-center">Error al añadir la clase.</div>';
    }
}

$query_entrenadores = "SELECT id_entrenador, nombre FROM entrenador";
$result_entrenadores = $mysqli->query($query_entrenadores);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
    <title>Añadir Clases - GymShark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #333;
            color: #ddd;
        }
        .form-container {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .boton-añadir {
            background-color: #555;
        }
        .boton-añadir:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-uppercase text-light mb-4">Añadir Clases - GymShark</h1>
        <div class="form-container mx-auto" style="max-width: 600px;">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nombre_clase" class="form-label">Nombre de la Clase</label>
                    <input type="text" class="form-control" id="nombre_clase" name="nombre_clase" required>
                </div>
                <div class="mb-3">
                    <label for="capacidad" class="form-label">Capacidad</label>
                    <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="id_entrenador" class="form-label">Entrenador</label>
                    <select class="form-select" id="id_entrenador" name="id_entrenador" required>
                        <option value="" disabled selected>Seleccione un entrenador</option>
                        <?php while ($row = $result_entrenadores->fetch_assoc()) { ?>
                            <option value="<?= $row['id_entrenador'] ?>"><?= $row['nombre'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dia_semana" class="form-label">Día de la Semana</label>
                    <select class="form-select" id="dia_semana" name="dia_semana" required>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora</label>
                    <input type="time" class="form-control" id="hora" name="hora" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn boton-añadir btn-lg">Añadir Clase</button>
                    <a href="index.html" class="btn boton-volver btn-lg">Volver al Inicio</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
