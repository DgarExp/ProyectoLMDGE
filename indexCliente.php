<?php
require 'conexion.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

$result = $mysqli->query("SELECT nombre FROM cliente WHERE id_cliente = $userId");
$row = $result->fetch_assoc();
$nombreUsuario = $row['nombre'];
$result->close();

$queryClases = "
    SELECT c.id_clase, c.nombre_clase, iv.dia_semana, iv.hora
    FROM inscripccion i
    JOIN clase c ON i.id_clase = c.id_clase
    JOIN intervalo iv ON c.id_clase = iv.id_clase
    WHERE i.id_cliente = $userId
";

$resultClases = $mysqli->query($queryClases);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salir_clase'])) {
    $idClase = $_POST['id_clase'];

    if ($mysqli->query("DELETE FROM inscripccion WHERE id_cliente = $userId AND id_clase = $idClase")) {
        $mysqli->query("UPDATE clase SET inscritos = inscritos - 1 WHERE id_clase = $idClase");
        echo "<script>alert('Te has salido de la clase correctamente.'); window.location.href = 'indexCliente.php';</script>";
    } else {
        echo "<script>alert('Error al intentar salir de la clase.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #121212; 
            color: white; 
        }
        .table { 
            background-color: #343a40; 
            color: white; 
        }
        .table th, .table td { 
            border-color: #495057; 
        }
        .btn-danger { 
            margin: 0 10px; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Bienvenido, <?php echo $nombreUsuario; ?>!</h1>
        <h3 class="text-center mt-4">Tus Clases</h3>
        <table class="table table-bordered table-dark mt-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultClases->num_rows > 0) {
                    while ($row = $resultClases->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_clase'] . "</td>";
                        echo "<td>" . $row['dia_semana'] . "</td>";
                        echo "<td>" . $row['hora'] . "</td>";
                        echo "<td>
                                <form method='POST' action='indexCliente.php'>
                                    <input type='hidden' name='id_clase' value='" . $row['id_clase'] . "'>
                                    <button type='submit' name='salir_clase' class='btn btn-danger'>Salirse</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No estás inscrito en ninguna clase.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-dark me-2">Cerrar Sesión</a>
            <a href="apuntarse.php" class="btn btn-secondary">Apuntarse a Clases</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
