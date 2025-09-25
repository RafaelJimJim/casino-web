<?php
// Verifica si la sesión ya está iniciada; si no, la inicia.
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Comprueba si existe una sesión activa con un usuario logueado.
if (isset($_SESSION['usuario'])) {
    // Almacena el nombre del usuario logueado.
    $usuario_logueado = $_SESSION['usuario'];
    // Establece el saldo del usuario desde la sesión; si no existe, se pone en 0.
    $saldo = isset($_SESSION['saldo']) ? $_SESSION['saldo'] : 0;
} else {
    // Indica que no hay usuario logueado.
    $usuario_logueado = false;
    // Saldo inicial por defecto si no hay sesión.
    $saldo = 0;
}
?>

<!-- Barra de navegación usando Bootstrap -->
<nav class="navbar navbar-expand-lg bg-primary" style="border-bottom: 1px solid black;">
  <div class="container-fluid" style="max-width: 1000px;">
    
    <!-- Botón responsive para pantallas pequeñas -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" 
    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Contenido colapsable de la barra de navegación -->
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      
      <!-- Lista de enlaces principales (menú) -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Logo de la página que redirige al inicio -->
        <li class="nav-item">
          <a class="navbar-brand" href="index.php">
            <img src="../imagenes/logo.png" alt="Logo">
          </a>
        </li>
        <!-- Enlace activo "Tragaperras" -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" style="color: white; font-family: Roboto, sans-serif;">Tragaperras</a>
        </li>
        <!-- Enlace "Casino" -->
        <li class="nav-item">
          <a class="nav-link" href="#" style="color: white; font-family: Roboto, sans-serif;">Casino</a>
        </li>
      </ul>
      
      <!-- Formulario con elementos dinámicos según sesión -->
      <form class="d-flex" role="search">
        
        <!-- Si el usuario está logueado, muestra el menú de usuario -->
        <?php if ($usuario_logueado): ?>
          <!-- Menú desplegable del usuario -->
          <div class="dropdown">
            <a href="#" class="dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../imagenes/usuario.png" alt="Usuario" style="width: 30px; height: 30px; border-radius: 50%;">
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
              <li><a class="dropdown-item" href="cerrarsesion.php">Cerrar sesión</a></li>
            </ul>
          </div>
          
          <!-- Saldo del usuario actualizado en tiempo real -->
          <span class="text-white ms-3" style="font-size: 16px; line-height: 30px;">
            Saldo: <strong id="saldo-actual"><?php echo number_format($saldo, 2); ?>€</strong>
          </span>
          
          <!-- Botón para realizar depósitos -->
          <button type="button" id="btnDepositar" class="btn btn-sm btn-warning ms-2">Depositar</button>
        
        <!-- Si no está logueado, muestra opciones de login y registro -->
        <?php else: ?>
          <!-- Botón de inicio de sesión -->
          <button class="btn btn-sm btn-outline-secondary me-2" type="button" 
          style="color: rgb(233, 193, 14); font-family: Roboto, sans-serif; border: 0px;" onclick="window.location.href='login.php'">
            ENTRAR
          </button>
          <!-- Botón para registrarse -->
          <a href="registro.php" class="btn btn-warning text-dark">REGISTRAR</a>
        <?php endif; ?>
        
      </form>
    </div>
  </div>
</nav>
