<?php
require 'conexion.php';

$query = "
    SELECT c.nombre_clase, i.dia_semana, i.hora
    FROM clase c
    INNER JOIN intervalo i ON c.id_clase = i.id_int
    ORDER BY i.dia_semana, i.hora
";

$result = $mysqli->query($query);
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
        .btn-volver {
            background-color: #555; 
            color: #fff; 
            display: block;
            width: 200px;
            margin: 30px auto;
            text-align: center;
            padding: 10px 0;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-volver:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-uppercase text-light mb-4">Clases GymShark</h1>

        <?php
        if ($result && $result->num_rows > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr><th>Nombre de Clase</th><th>Día de la Semana</th><th>Hora</th></tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['nombre_clase']}</td>";
                echo "<td>{$row['dia_semana']}</td>";
                echo "<td>{$row['hora']}</td>";
                echo "</tr>";
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-danger text-center">No se encontraron datos en las tablas.</div>';
        }

        $mysqli->close();
        ?>

        <a href="index.html" class="btn-volver">Volver al Inicio</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
