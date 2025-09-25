<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Configuración inicial del documento HTML -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index - Casinium</title>

  <!-- Fuente Roboto de Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  <!-- Estilos de Bootstrap (CSS) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="../style/header.css">
  <link rel="stylesheet" href="../style/index.css">
  <link rel="stylesheet" href="../style/disclaimer.css">

  <!-- Íconos de Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>

  <!-- Incluye el archivo header.php que contiene la barra de navegación -->
  <?php include('header.php'); ?>

  <!-- Carrusel de imágenes destacadas -->
  <div class="container" id="carrousel">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
      <!-- Indicadores inferiores del carrusel -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
      </div>
      <!-- Imágenes del carrusel -->
      <div class="carousel-inner">
        <!-- Primera imagen activa por defecto -->
        <div class="carousel-item active">
          <img src="../imagenes/carru1.jpg" class="d-block w-100" alt="Carrusel 1">
        </div>
        <div class="carousel-item">
          <img src="../imagenes/carru2.jpg" class="d-block w-100" alt="Carrusel 2">
        </div>
        <div class="carousel-item">
          <img src="../imagenes/carru3.jpg" class="d-block w-100" alt="Carrusel 3">
        </div>
      </div>
      <!-- Botones para navegar por el carrusel -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>

  <!-- Sección dinámica con tarjetas de juegos (tragaperras) -->
  <div class="container mt-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-3">
        <?php
                // Array de tragaperras con título, URL e imagen
            $tragaperras = [
              ["titulo" => "Tragaperras 1", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby_1-canita_brava_las_fallas.jpg"],
              ["titulo" => "Tragaperras 2", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby_1-el_secreto_de_las_piramides.jpg"],
              ["titulo" => "Tragaperras 3", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby_1-giro_estelar.jpg"],
              ["titulo" => "Tragaperras 4", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby_1-la_busqueda_del_jaguar.jpg"],
              ["titulo" => "Tragaperras 5", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby_1-lejano_oeste_mania_megaways.jpg"],
              ["titulo" => "Tragaperras 6", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby_1-llevate_la_pasta.jpg"],
              ["titulo" => "Tragaperras 7", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby_1-mar_dorado.jpg"],
              ["titulo" => "Tragaperras 8", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby_1-nuevas_tierras.jpg"],
              ["titulo" => "Tragaperras 9", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-777_caliente_megaways-mtd-1.jpg"],
              ["titulo" => "Tragaperras 10", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-arabian-mtd-1.jpg"],
              ["titulo" => "Tragaperras 11", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-big-chiquito-mtd.jpg"],
              ["titulo" => "Tragaperras 12", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-big-mina_oro_plus-mtd (1).jpg"],
              ["titulo" => "Tragaperras 13", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-buffalo-mtd.jpg"],
              ["titulo" => "Tragaperras 14", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-caveman-mtd-1.jpg"],
              ["titulo" => "Tragaperras 15", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-coccktails-mtd-1.jpg"],
              ["titulo" => "Tragaperras 16", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-gnomos_mix-mtd-1.jpg"],
              ["titulo" => "Tragaperras 17", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/lobby-roma_plus-mtd-1.jpg"],
              ["titulo" => "Tragaperras 18", "url" => "maquina_tragaperras.php", "imagen" => "../imagenes/Tragaperras-AndyLucas-Boton-Lobby-1.jpg"],
          ];

          // Bucle para generar dinámicamente las tarjetas de los juegos
          foreach ($tragaperras as $item) {
              $url = $usuario_logueado ? $item["url"] : "login.php";
              echo '
              <div class="col">
                  <div class="card h-100">
                      <a href="' . $url . '">
                          <img src="../imagenes/' . $item["imagen"] . '" class="card-img-top" alt="Tragaperras">
                      </a>
                      <div class="card-body text-center">
                          <p class="card-text">' . $item["titulo"] . '</p>
                      </div>
                  </div>
              </div>';
          }
        ?>
    </div>
</div>

  <!-- Sección con iconos de métodos de pago -->
  <div class="container-fluid text-center mt-5 pb-1 pt-3" id="iconos-redes">
    <ul class="list-unstyled list-inline">
      <li class="list-inline-item mx-2">
        <img src="../imagenes/visa.png">
      </li>
      <li class="list-inline-item mx-2">
        <img src="../imagenes/mastercard.png">
      </li>
      <li class="list-inline-item mx-2">
        <img src="../imagenes/bizum.png">
      </li>
      <li class="list-inline-item mx-2">
        <img src="../imagenes/paysafecard.png">
      </li>
      <li class="list-inline-item mx-2">
        <img src="../imagenes/skrill.png">
      </li>
      <li class="list-inline-item mx-2">
        <img src="../imagenes/paypal.png">
      </li>
      <li class="list-inline-item mx-2">
        <img src="../imagenes/transferencia.png">
      </li>
    </ul>
  </div>

  <!-- Footer completo -->
  <footer class="pt-4 pb-4">
    <div class="container-fluid mx-3">
        <div class="row">
          <div class="col-md-3 col-lg-3 col-xl-2 mx-auto mt-2">
            <ul class="list-unstyled">
                <li><h5 class="text-uppercase font-weight-bold text-light">Juegos</h5></li>
                <li><hr class="mb-3"></li>
                <li><a href="#" class="text-light">Tragaperras</a></li>
            </ul>
        </div>
        

          <div class="col-xl-2 mx-auto mt-2"> 
            <h5 class="text-uppercase font-weight-bold text-light">Sobre Casinium</h5>
            <hr class="mb-3"> 
            <ul class="list-unstyled">
                <li><a href="#" class="text-light">Juego más seguro</a></li>
                <li><a href="#" class="text-light">Juego autorizado</a></li>
                <li><a href="#" class="text-light">Reglas</a></li>
                <li><a href="#" class="text-light">FAQ</a></li>
                <li><a href="#" class="text-light">Depósitos y retiros</a></li>
                <li><a href="#" class="text-light">Blog</a></li>
                <li><a href="#" class="text-light">Soporte</a></li>
                <li><a href="#" class="text-light">Afiliados</a></li>
                <li><a href="#" class="text-light">Tu opinión importa</a></li>
            </ul>
        </div>
        

          <div class="col-xl-2 mx-auto mt-2 text-center"> 
            <img src="../imagenes/logo.png" class="footer-img">
            <ul class="list-unstyled list-inline">
              <li class="list-inline-item">
                <a href="#" class="text-light"><i class="fab fa-facebook fa-2x"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-light"><i class="fab fa-twitter fa-2x"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="text-light"><i class="fab fa-instagram fa-2x"></i></a>
              </li>
              
              <li class="list-inline-item">
                <a href="#" class="text-light"><i class="fab fa-youtube fa-2x"></i></a>
              </li>
            </ul>
            <div class="card-body">
              <p class="text-md-center">Casinium.es está autorizada por la Dirección General de Ordenación del Juego para la explotación de todos los juegos ofertados</p>
            </div>
          </div>

          <div class="col-xl-2 mx-auto mt-2"> 
            <ul class="list-unstyled">
              <li><h3 class="text-uppercase font-weight-bold text-light">LLÁMANOS GRATIS</h3></li>
              <li><h1 class="font-weight-bold text-yellow">963 866 000</h1></li>
              <li><h6>Teléfono gratuito, a tu disposición las 24h del día de lunes a domingo</h6></li>
            </ul>

            <ul class="list-unstyled list-inline text-center">
              <li class="list-inline-item me-5">
                <a href="#" class="text-light"><i class="fas fa-comments fa-3x"></i></a>
              </li>
              <li class="list-inline-item me-5 mt-4">
                <a href="#" class="text-light"><i class="fas fa-envelope fa-3x"></i></a>
              </li>
              <li class="list-inline-item me-4">
                <i class="fas fa-phone-alt fa-3x"></i>
              </li>
            </ul>            
          </div>

          <div class="col-xl-2 mx-auto mt-2 text-center">
            <ul class="list-unstyled">
              <li class="list-inline-item mx-2">
                <h9 class="d-block" style="border: solid 1px; padding: 2px 20px;">JUEGA CON RESPONSABILIDAD</h9>
              </li>      
              <li class="list-inline-item mx-2">
                <p>Sin diversión no hay juego</p>
              </li>
                <a href="#"><img src="../imagenes/Icon_JugarBien_Footer.png" ></a>
                <a href="#"><img src="../imagenes/Icon_JuegoSeguro_Footer.png" ></a>
              </ul>

            <ul class="list-unstyled list-inline d-flex justify-content-center">
                <li class="list-inline-item mx-2">
                    <a href="#"><img src="../imagenes/Icon_AutoExclusion_Footer.png" style="width: 50px; height: auto;"></a>
                </li>
                <li class="list-inline-item mx-2">
                    <a href="#"><img src="../imagenes/Icon_+18_Footer.png" style="width: 50px; height: auto;"></a>
                </li>
                <li class="list-inline-item mx-2">
                    <a href="#"><img src="../imagenes/Icon_ConfianzaOnline_Footer.png" style="width: 50px; height: auto;"></a>
                </li>
            </ul>
        </div>
        
        </div>
        <hr class="mb-4">
        <div class="text-left ms-4">
          <p>
            Copyright Todos los derechos reservados
          </p>
        </div>
    </div>
  </footer>

   <!-- Modal de Confirmación de Edad -->
<div id="disclaimer-modal" class="disclaimer-overlay" style="display: none;">
    <div class="disclaimer-content">
        <h2>Confirmación de Edad</h2>
        <p>Debes tener al menos 18 años para acceder a este sitio. ¿Eres mayor de edad?</p>
        <button id="aceptar-btn">Sí, soy mayor de 18 años</button>
        <button id="rechazar-btn">No</button>
    </div>
</div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/depositar.js"></script>
<script src="../js/disclaimer.js"></script>


</body>

</html>