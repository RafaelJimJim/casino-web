<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("Content-Type: application/json");
include('config.php');
include('lib.php');

error_reporting(E_ALL);  
ini_set('display_errors', 1);

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    echo json_encode(["error" => "No estás autenticado."]);
    exit;
}

$usuario = $_SESSION['usuario'];
error_log("Usuario en sesión: " . $usuario);

// Si es una solicitud GET, devuelve el saldo actual
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $saldo = obtenerSaldo($usuario);
    echo json_encode(["saldo" => number_format($saldo, 2)]);
    exit;
}

// Si es POST y se envía el parámetro de depósito, realiza el depósito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['depositar']) && $_POST['depositar'] === 'true') {
    $monto = 200;  // Monto a depositar
    $total_saldo = obtenerSaldo($usuario);
    error_log("Saldo antes del depósito: $total_saldo");
    if ($total_saldo >= 400) {
        echo json_encode(["error" => "Ya tienes saldo suficiente."]);
        exit;
    }
    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);
    $sql = "INSERT INTO saldo (id_usuario, saldo, procedencia_saldo) 
            VALUES ((SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?), ?, 0)";
    $stmt = $conexion->prepare($sql);
    if ($stmt->execute([$usuario, $monto])) {
        error_log("Depósito insertado para $usuario, monto: $monto");
        $total_saldo = obtenerSaldo($usuario);
        error_log("Saldo después del depósito: $total_saldo");
        echo json_encode(["success" => "Depósito realizado con éxito.", "total_saldo" => number_format($total_saldo, 2)]);
        exit;
    } else {
        error_log("Error al insertar depósito para $usuario");
        echo json_encode(["error" => "Hubo un error al intentar hacer el depósito."]);
        exit;
    }
}

echo json_encode(["error" => "Solicitud inválida."]);
exit;
?>
