<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Configuración básica de la página -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>

  <!-- Inclusión de la fuente Roboto desde Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Inclusión del framework CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos personalizados para el registro -->
  <link rel="stylesheet" href="../style/registro.css">
</head>
<body>

  <!-- Contenedor principal centrado verticalmente y horizontalmente -->
  <div class="container min-vh-100 d-flex flex-column align-items-center justify-content-center">
    
    <!-- Logo superior que enlaza a la página principal -->
    <div class="mb-4">
      <a href="index.php">
        <img src="../imagenes/logo (1).png" alt="Logo" class="img-fluid" style="max-width: 150px;">
      </a>
    </div>

    <!-- Formulario de registro -->
    <div class="col-lg-6 col-md-8 col-12">
      <form class="shadow p-4 bg-white rounded-3" id="container" method="POST" action="registro_back.php">
        
        <!-- Título del formulario -->
        <h3 class="text-center mb-4">Registro</h3>

        <!-- Campo para introducir el nombre de usuario -->
        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario</label>
          <input type="text" class="form-control" id="usuario" name="usuario">
        </div>

        <!-- Campo para introducir el correo electrónico -->
        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>

        <!-- Campo para introducir la contraseña -->
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" name="pass">
        </div>

        <!-- Campo para repetir la contraseña -->
        <div class="mb-3">
          <label for="repetirPassword" class="form-label">Repetir Contraseña</label>
          <input type="password" class="form-control" id="repetirPassword" name="repetirpass">
        </div>

        <!-- Sección PHP para mostrar mensajes dinámicos -->
        <?php
        session_start();  // Inicia o continúa la sesión actual

        // Mostrar mensaje de error guardado en la sesión, si existe
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger small" role="alert">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Elimina el mensaje tras mostrarlo
        }

        // Mostrar mensaje de éxito si se registró correctamente
        if (isset($_GET['registro_exitoso']) && $_GET['registro_exitoso'] == 'true') {
            echo '<div class="alert alert-success" role="alert">¡Usuario registrado correctamente!</div>';
        }
        ?>

        <!-- Botón de envío del formulario -->
        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-primary">Registrarse</button>
        </div>
        
      </form>
    </div>
  </div>

  <!-- Inclusión del archivo JavaScript personalizado para registro -->
  <script src="../js/registro.js"></script>

</body>
</html>
