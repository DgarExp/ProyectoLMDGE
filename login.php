<?php
require 'conexion.php';

session_start();

$error = "";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (!empty($email) && !empty($password)) {
        $query = "SELECT id_cliente, contraseña FROM cliente WHERE email = '$email'";
        $result = $mysqli->query($query);

        if ($result && $result->num_rows > 0) {
            $cliente = $result->fetch_assoc();
            $userId = $cliente['id_cliente'];
            $encriptado = $cliente['contraseña'];
            
            if (password_verify($password, $encriptado)) {
                $_SESSION['user_id'] = $userId; 
                header("Location: indexCliente.php");
                exit();
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Correo no registrado.";
        }
    } else {
        $error = "Por favor, complete todos los campos.";
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJYXA6Xy3XvQ9Wj1z8MeYwKwD3uQ/jPjJe5Aqg++44o5lA0FSknv6p2uKP3l" crossorigin="anonymous">
    <style>
        body {
            background-color: #121212;
            color: white;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            margin: 0;
        }
        .alert {
            background-color: #343a40; 
            color: white;
            width: 400px;  
            text-align: center;
            padding: 20px;
            border-radius: 5px;
        }
        .boton-inicio {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 18px;
            padding: 10px 20px;
            text-decoration: none;
        }
        .boton-inicio:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .container {
            text-align: center;
            padding: 20px;
            background-color: #2a2a2a;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 500px;  
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
        <a href="login.html" class="btn btn-primary">Volver a intentar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb6IbIHj6FS9xpp9NzpTq9zPQ98XBb6G5yo9w3XzHg8bIg4NB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqJv95Ruv6giU4+5ohJ6XsWlBeOhAi2jtHfQU5xUBg5F2" crossorigin="anonymous"></script>
</body>
</html>
