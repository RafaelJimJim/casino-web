<?php
// Verifica si la sesión está iniciada; si no, la inicia.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluye archivos de configuración y funciones auxiliares
require_once('config.php');
require_once('lib.php');

// Indica que la respuesta será en formato JSON
header("Content-Type: application/json");

// ✅ Obtener los datos enviados en la solicitud (POST o JSON)
$action = $input['action'] ?? ($_POST['action'] ?? null); // Obtiene el valor de 'action' desde JSON o POST

// Verifica si el usuario está autenticado antes de ejecutar cualquier acción
if (!isset($_SESSION['usuario'])) {
    echo json_encode(["error" => "No estás autenticado."]);
    exit;
}

// Ejecuta la acción correspondiente según el valor recibido en 'action'
switch ($action) {
    case "jugar":
        jugar();
        break;
    case "obtener_saldo":
        obtener_saldo();
        break;
    default:
        // Si la acción no es válida, responde con un error en JSON
        echo json_encode(["error" => "Acción no válida."]);
        break;
}

// ✅ FUNCIÓN PARA INICIAR UNA PARTIDA
function jugar() {
    // Obtiene el usuario en sesión y su saldo actual
    $usuario = $_SESSION['usuario'];
    $saldo = obtenerSaldo($usuario);

    // Verifica si el usuario tiene saldo suficiente para jugar
    if ($saldo <= 0) {
        echo json_encode(["error" => "No tienes suficiente saldo para jugar."]);
        exit;
    }

    // Definición de imágenes y premios asociados a cada una
    $imagenes = ["moneda.jpg", "comida-sana.png", "tortuga.png", "leon.png", "tienda-online.png", "charla.png", "fresco.png"];
    $premios = [1, 2, 3, 4, 5, 6, 7];

    // 🔥 Configura la probabilidad de ganar (ajustar para modificar la dificultad)
    $probabilidad_ganar = 10; // Cuanto mayor es este número, más probable es ganar
    $random = rand(1, 100); // Genera un número aleatorio entre 1 y 100

    // Determina si el usuario gana o pierde en esta partida
    if ($random <= $probabilidad_ganar) {
        // Si gana, elige un número de premio aleatorio y genera una combinación ganadora
        $numero_ganador = rand(0, count($imagenes) - 1);
        $numeros_actuales = [$numero_ganador, $numero_ganador, $numero_ganador]; // 3 iconos iguales
        $premio = $premios[$numero_ganador]; // Se obtiene el premio asociado
    } else {
        // Si pierde, genera una combinación aleatoria sin garantía de premio
        do {
            $numeros_actuales = [
                rand(0, count($imagenes) - 1),
                rand(0, count($imagenes) - 1),
                rand(0, count($imagenes) - 1)
            ];
        } while ($numeros_actuales[0] === $numeros_actuales[1] && $numeros_actuales[1] === $numeros_actuales[2]);
        
        $premio = 0; // No hay premio
    }

    // ✅ Guarda el cambio en saldo en la base de datos
    global $servidor, $usuarioservidor, $claveservidor, $opcionesPDO;
    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);

    // Inserta el cambio en saldo (premio menos costo de la jugada)
    $sql = "INSERT INTO saldo (id_usuario, saldo, procedencia_saldo) 
            VALUES ((SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?), ?, 1)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario, ($premio - 1)]); // ✅ Se descuenta 1 de saldo por jugar y se suma el premio si aplica

    // ✅ Obtiene el saldo actualizado después de la jugada
    $saldo = obtenerSaldo($usuario);
    $_SESSION['saldo'] = $saldo; // Actualiza el saldo en la sesión

    // Retorna la respuesta en formato JSON con los resultados de la jugada
    echo json_encode([
        "success" => true,
        "saldo" => $saldo, // Saldo actualizado
        "numeros_actuales" => $numeros_actuales, // Combinación de iconos obtenida
        "imagenes" => $imagenes, // Lista de imágenes utilizadas
        "premio" => $premio // Monto del premio obtenido
    ]);
}

// ✅ FUNCIÓN PARA OBTENER EL SALDO DEL USUARIO
function obtener_saldo() {
    // Obtiene el usuario en sesión y su saldo actual
    $usuario = $_SESSION['usuario'];
    $saldo = obtenerSaldo($usuario);

    // Devuelve la respuesta en JSON con el saldo del usuario
    echo json_encode(["success" => true, "saldo" => $saldo]);
}
