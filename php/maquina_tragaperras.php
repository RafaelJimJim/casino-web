<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máquina Tragaperras</title>
    <link rel="stylesheet" href="../style/maquina_tragaperras.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="../js/maquina.js"></script>
</head>
<body>

<header>
    <div id="logo-container">
        <a href="index.php">
            <img id="logo" src="../imagenes/logo.png" alt="Logo">
        </a>
    </div>
    <div id="linea1">
        <div id="credito">Crédito:</div>
        <div id="dinero"></div>
        <div id="euro">€</div>
        <div id="tirar">Tirar</div>
    </div>
</header>


    <section id="ventanas">
        <div class="ventana">
            <div class="imagen">
                <img src="../imagenes/moneda.jpg">
            </div>
        </div>

        <div class="ventana">
            <div class="imagen">
                <img src="../imagenes/moneda.jpg">
            </div>
        </div>

        <div class="ventana">
            <div class="imagen">
                <img src="../imagenes/moneda.jpg">
            </div>
        </div>
    </section>

    <div id="velo">
        <div id="cuadro_mensaje">
            <img id="cruz" src="../imagenes/cruz-cerrar.png">
            <div id="mensaje"></div>
        </div>
    </div>

    <audio id="sonido" src="../audio/lanzar.mp3"></audio>
</body>
</html>
