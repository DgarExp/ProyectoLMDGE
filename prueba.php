<?php

require 'conexion.php';

// Consulta SQL para obtener datos de la tabla cliente
$sql = "SELECT nombre, dni, email FROM cliente";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Clientes</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
        }
        .table {
            color: #f1f1f1; 
            text-align: center; 
        }
        .table th {
            background-color: #343a40; 
            color: #ffffff;
            text-align: center; 
        }
        .table tbody tr:nth-child(even) {
            background-color: #1f1f1f; 
        }
        .table tbody tr:nth-child(odd) {
            background-color: #2c2c2c; 
        }
        .table tbody tr:hover {
            background-color: #3a3a3a; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Clientes</h1>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    if ($resultado->num_rows > 0) {
                        
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                            echo "<td>" . htmlspecialchars($fila["dni"]) . "</td>";
                            echo "<td>" . htmlspecialchars($fila["email"]) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay datos disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar conexión
$conexion->close();
?>
