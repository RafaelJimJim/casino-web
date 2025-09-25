<?php
$servidor = 'mysql:host=localhost;dbname=casino;port=3306;charset=utf8'; 
$usuarioservidor = 'USUARIO_LOCAL'; 
$claveservidor = 'CONTRASEÑA_LOCAL'; 
$opcionesPDO = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conexion = new PDO($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
