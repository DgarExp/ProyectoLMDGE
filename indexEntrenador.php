<?php
require 'conexion.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); 
    exit();
}

$emailEntrenador = $_SESSION['email']; 

$queryEntrenador = "SELECT id_entrenador, nombre FROM entrenador WHERE email = '$emailEntrenador'";
$resultEntrenador = $mysqli->query($queryEntrenador);

if ($resultEntrenador->num_rows > 0) {
    $rowEntrenador = $resultEntrenador->fetch_assoc();
    $idEntrenador = $rowEntrenador['id_entrenador'];
    $nombreEntrenador = $rowEntrenador['nombre'];
} else {
    header("Location: login.php");
    exit();
}

$queryClases = "SELECT nombre_clase, capacidad, inscritos FROM clase WHERE id_entrenador = $idEntrenador";
$resultClases = $mysqli->query($queryClases);
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
            background-color: #1e1e1e;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; 
            align-items: center;
            margin: 0;
        }
        .container {
            max-width: 800px;
            width: 100%;
            flex: 1;
        }
        .card {
            background-color: #212529;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
        }
        .card-title {
            font-size: 48px; 
            font-weight: bold;
        }
        .boton-cerrar {
            background-color: #dc3545; 
            border-color: #dc3545; 
            font-size: 20px;
            padding: 15px 30px;
            width: 100%; 
            margin-top: 20px;
        }
        .boton-cerrar:hover {
            background-color: #c82333; 
            border-color: #c82333; 
        }
        table {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #444;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1 class="card-title">Bienvenido, <?php echo $nombreEntrenador; ?>!</h1>

            <h2 class="mt-4">Tus Clases</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Nombre de la Clase</th>
                        <th>Capacidad</th>
                        <th>Inscritos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultClases->num_rows > 0) {
                        while ($row = $resultClases->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['nombre_clase'] . "</td>";
                            echo "<td>" . $row['capacidad'] . "</td>";
                            echo "<td>" . $row['inscritos'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No tienes clases asignadas.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <a href="index.html" class="btn boton-cerrar">Cerrar Sesión</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb6IbIHj6FS9xpp9NzpTq9zPQ98XBb6G5yo9w3XzHg8bIg4NB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqJv95Ruv6giU4+5ohJ6XsWlBeOhAi2jtHfQU5xUBg5F2" crossorigin="anonymous"></script>
</body>
</html>

<?php
$mysqli->close();
?>
