<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/icono.png" type="image/x-icon">
    <title>Administrador de GymShark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #333;
            color: #ddd;
        }
        .container {
            margin-top: 40px;
        }
        .card {
            background-color: #444;
            border: none;
        }
        .form-label {
            color: #ddd;
        }
        .form-control {
            background-color: #555;
            border: 1px solid #666;
            color: #fff;
        }
        .form-control:focus {
            background-color: #555;
            border-color: #777;
            box-shadow: none;
        }
        .boton-registro {
            background-color: #666;
            border-color: #555;
        }
        .boton-registro:hover {
            background-color: #555;
            border-color: #444;
        }
        .boton-inicio {
            background-color: #666;
            border-color: #555;
            color: #fff;
            margin-top: 10px;
        }
        .boton-inicio:hover {
            background-color: #555;
            border-color: #444;
        }
        .header-title {
            font-size: 32px;
            font-weight: bold;
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="header-title">GymShark</h1>

        <?php
        require 'entrenadoresRegistro1.php'; // Llamar al archivo backend para el procesamiento

        if ($success): ?>
            <div class="alert alert-success text-center">
                <?= $success; ?>
            </div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger text-center">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="POST" action="entrenadoresRegistro.php">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu email" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" required>
                            </div>
                            <button type="submit" class="btn boton-registro w-100">Registrar Entrenador</button>
                        </form>
                        <a href="login_entrenador2.php" class="btn boton-inicio w-100 text-center">Inicia Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
