<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($controla)) {
    if($controla){
        if (empty($_SESSION['idusuario'])) {
            header('Location: index.php');
            exit;
        }
    }
}

if (!function_exists('conectarse')) {
    function conectarse($servidor, $usuarioservidor, $claveservidor, $opcionesPDO) {
        try {
            $conectado = new PDO($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);
            return $conectado;
        } catch (PDOException $e) {
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            die("Error al conectar con la base de datos.");
        }
    }
}

function obtenerSaldo($usuario) {
    global $servidor, $usuarioservidor, $claveservidor, $opcionesPDO;
    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);
    $sql = "SELECT SUM(saldo) AS total_saldo FROM saldo WHERE id_usuario = (SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    error_log("Resultado de saldo para $usuario: " . print_r($resultado, true));
    return isset($resultado['total_saldo']) ? $resultado['total_saldo'] : 0;
}



