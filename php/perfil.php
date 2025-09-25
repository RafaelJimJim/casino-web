<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../style/perfil.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Perfil de <?php echo htmlspecialchars($usuario); ?></h1>

    <h2>Historial de Jugadas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Saldo</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody id="jugadas-table">
            <!-- Las jugadas se cargarán aquí dinámicamente -->
        </tbody>
    </table>

    <div id="paginacion">
        <button id="btnAnterior" class="btn" disabled>← Anterior</button>
        <span id="paginaActual"></span>
        <button id="btnSiguiente" class="btn">Siguiente →</button>
    </div>

    <a href="index.php" class="boton-volver">Volver al Inicio</a>

    <script src="../js/perfil.js"></script>

        
</body>
</html>
