<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Enlace a la fuente Roboto de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Enlace al framework Bootstrap para estilos y diseño responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Enlace a la hoja de estilos personalizada -->
    <link rel="stylesheet" href="../style/registro.css">
</head>
<body>

    <!-- Contenedor principal que centra verticalmente el contenido en la pantalla -->
    <div class="container min-vh-100 d-flex flex-column align-items-center justify-content-center">
        
        <!-- Logo superior con enlace a la página principal -->
        <div class="mb-4">
            <a href="index.php">
                <img src="../imagenes/logo (1).png" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </a>
        </div>

        <!-- Formulario de inicio de sesión -->
        <div class="col-lg-6 col-md-8 col-12">
            <form class="shadow p-4 bg-white rounded-3" id="container" method="POST" action="control.php">
                <h3 class="text-center mb-4">Iniciar Sesión</h3>

                <!-- Campo para ingresar el nombre de usuario -->
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" autofocus autocomplete="username">
                </div>

                <!-- Campo para ingresar la contraseña -->
                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave" autocomplete="current-password">
                </div>

                <!-- Sección PHP para mostrar mensajes de error en caso de fallo en el inicio de sesión -->
                <?php
                session_start(); // Inicia la sesión para acceder a variables de sesión

                // Si hay un mensaje de error almacenado en la sesión, se muestra en pantalla
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="alert alert-danger small" role="alert">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']); // Elimina el mensaje de error tras mostrarlo
                }
                ?>

                <!-- Botón para enviar el formulario de inicio de sesión -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
