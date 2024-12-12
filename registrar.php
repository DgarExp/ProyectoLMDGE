<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Gym Shark - Registro</title>
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
</head>
<body class="bg-dark">
    <style>
        
        body {
            background-color: #333;
            color: #ddd; 
            height: 100%;
        }

        .container {
            margin-top: 80px; 
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); 
            background-color: #444; 
        }

        .card-header {
            background-color: #222;
            color: #fff;
            font-weight: bold;
            font-size: 24px;
            text-align: center;
        }

        .card-body {
            background-color: #555;
            padding: 32px; 
            border-radius: 15px;
        }

        .btn {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            border: none;
            padding: 10px 20px;
            width: 100%;
            font-size: 16px; 
        }

        .btn:hover {
            background-color: #218838; 
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #666;
            background-color: #666;
            color: #fff;
            margin-bottom: 16px; 
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        .img-logo {
            width: 120px; 
            margin-bottom: 16px; 
        }

        .footer {
            text-align: center;
            margin-top: 48px; 
            color: #bbb;
        }
    </style>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <img src="Imagenes/logo.png" alt="Logo" class="img-logo">
                        <h4>Registro de Usuario</h4>
                    </div>
                    <div class="card-body">
                        <form action="registrar2.php" method="POST">
                            <div class="form-group">
                                <label for="nombre">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                            </div>
                            <button type="submit" class="btn">Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enlace a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
