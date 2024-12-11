<?php
require 'conexion.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_clase'])) {
    $idClaseSeleccionada = $_POST['id_clase'];

    $insertInscripcion = "INSERT INTO inscripccion (id_cliente, id_clase) VALUES ($userId, $idClaseSeleccionada)";
    if ($mysqli->query($insertInscripcion)) {
        $updateClase = "UPDATE clase SET inscritos = inscritos + 1 WHERE id_clase = $idClaseSeleccionada";
        $mysqli->query($updateClase);

        echo "<script>alert('¡Te has inscrito correctamente!'); window.location.href = 'apuntarse.php';</script>";
    } else {
        echo "<script>alert('Error al inscribirse.');</script>";
    }
}

$queryClasesDisponibles = "
    SELECT c.id_clase, c.nombre_clase, c.capacidad, c.inscritos
    FROM clase c
    WHERE c.inscritos < c.capacidad
    AND c.id_clase NOT IN (
        SELECT i.id_clase
        FROM inscripccion i
        WHERE i.id_cliente = $userId
    )
";

$resultClases = $mysqli->query($queryClasesDisponibles);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
    <title>Apuntarse a Clases</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #121212; 
            color: white; 
        }
        .container { 
            margin-top: 50px; 
        }
        .table { 
            background-color: #343a40; 
            color: white; 
        }
        .table th, .table td { 
            border-color: #495057; 
        }
        .btn { 
            margin-top: 20px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Clases Disponibles</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th>Nombre de la Clase</th>
                        <th>Capacidad</th>
                        <th>Inscritos</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultClases->num_rows > 0) {
                        while ($row = $resultClases->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['nombre_clase']}</td>";
                            echo "<td>{$row['capacidad']}</td>";
                            echo "<td>{$row['inscritos']}</td>";
                            echo "<td>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='id_clase' value='{$row['id_clase']}'>
                                        <button type='submit' class='boton boton-registro'>Registrarse</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No hay clases disponibles.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <a href="indexCliente.php" class="boton boton-volver">Volver</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
