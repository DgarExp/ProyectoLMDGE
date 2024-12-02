<?php
require 'conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (!empty($email) && !empty($password)) {
        
        $stmt = $mysqli->prepare("SELECT id_cliente, contraseña FROM cliente WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $encriptado);
            $stmt->fetch();
            
            
            if (password_verify($password, $encriptado)) {
                //Guardamos los datos del usuario
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_email'] = $email;
                
                header("Location: index.html");
                exit();
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Correo no registrado.";
        }
        $stmt->close();
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Error de Inicio de Sesión</title>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger text-center">
            <p><?php echo isset($error) ? htmlspecialchars($error) : 'Hubo un problema con el inicio de sesión.'; ?></p>
            <a href="login.html" class="btn btn-primary">Volver a intentar</a>
        </div>
    </div>
</body>
</html>
