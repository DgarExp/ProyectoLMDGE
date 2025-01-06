<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_clase'])) {
    $id_clase = (int) $_POST['id_clase']; 
    $delete_query = "DELETE FROM clase WHERE id_clase = $id_clase";

    if ($mysqli->query($delete_query)) {
        echo '<div class="alert alert-success text-center">Clase eliminada con éxito.</div>';
    } else {
        echo '<div class="alert alert-danger text-center">Error al eliminar la clase.</div>';
    }
}

$query = "
    SELECT c.id_clase, c.nombre_clase, i.dia_semana, i.hora
    FROM clase c
    INNER JOIN intervalo i ON c.id_clase = i.id_int
    ORDER BY i.dia_semana, i.hora
";

$resultado = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
    <title>Clases GymShark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #333; 
            color: #ddd;
        }
        table {
            background-color: #444; 
            color: #fff; 
        }
        th {
            background-color: #555; 
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #666; 
        }
        .boton-eliminar {
            background-color: #e63946; 
            color: #fff;
            border: none;
        }
        .boton-eliminar:hover {
            background-color: #dc3545; 
        }
        .boton-comun {
            background-color: #333; 
            color: #fff;
            border: none;
        }
        .boton-comun:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-uppercase text-light mb-4">Clases GymShark</h1>

        <?php
        if ($resultado && $resultado->num_rows > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr><th>Nombre de Clase</th><th>Día de la Semana</th><th>Hora</th><th>Acciones</th></tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $resultado->fetch_assoc()) {
        ?>
                <tr>
                    <td><?= $row['nombre_clase'] ?></td>
                    <td><?= $row['dia_semana'] ?></td>
                    <td><?= $row['hora'] ?></td>
                    <td>
                        <form method="POST" action="eliminar.php" class="d-inline">
                            <input type="hidden" name="id_clase" value="<?= $row['id_clase'] ?>">
                            <button type="submit" class="btn boton-eliminar btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
        <?php
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-danger text-center">No se encontraron datos en las tablas.</div>';
        }
        $mysqli->close();
        ?>

        <div class="text-center">
            <a href="crear_clase.php" class="btn boton-comun btn-lg">Agregar Clase</a>
            <a href="index.html" class="btn boton-comun btn-lg ms-3">Volver al Inicio</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
