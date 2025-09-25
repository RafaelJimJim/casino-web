<?php
// ✅ Verifica si la sesión está iniciada; si no, la inicia
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Incluye los archivos de configuración y funciones auxiliares
require_once('config.php');
require_once('lib.php');

// ✅ Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    echo json_encode(["error" => "No estás autenticado."]);
    exit;
}

// ✅ Obtiene el nombre de usuario desde la sesión
$usuario = $_SESSION['usuario'];

// ✅ Establece la conexión con la base de datos
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);

// 🔥 Configuración de la paginación
$limite = 10; // Número de jugadas por página
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1; // Obtiene el número de página o usa la primera por defecto
$inicio = ($pagina - 1) * $limite; // Calcula desde qué registro empezar

// 🔥 Consulta SQL para obtener el historial de jugadas con paginación
$sql = "SELECT fecha, saldo, procedencia_saldo 
        FROM saldo 
        WHERE id_usuario = (SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?)
        ORDER BY fecha DESC 
        LIMIT ?, ?";

$stmt = $conexion->prepare($sql);
$stmt->bindValue(1, $usuario, PDO::PARAM_STR);
$stmt->bindValue(2, $inicio, PDO::PARAM_INT);
$stmt->bindValue(3, $limite, PDO::PARAM_INT);
$stmt->execute();

// ✅ Obtiene todas las jugadas como un array asociativo
$jugadas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 🔥 Consulta para contar el total de registros y calcular el número total de páginas
$sqlTotal = "SELECT COUNT(*) as total FROM saldo WHERE id_usuario = (SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?)";
$stmtTotal = $conexion->prepare($sqlTotal);
$stmtTotal->execute([$usuario]);
$totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
$totalPaginas = ceil($totalRegistros / $limite); // Calcula el total de páginas necesarias

// ✅ Devuelve la respuesta en formato JSON con la información del historial y paginación
echo json_encode([
    "jugadas" => $jugadas, // Lista de jugadas obtenidas
    "pagina_actual" => $pagina, // Página actual
    "total_paginas" => $totalPaginas // Total de páginas disponibles
]);
?>
