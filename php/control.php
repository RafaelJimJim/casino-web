<?php
// Se incluyen los archivos de configuración y funciones adicionales
include('config.php');
include('lib.php');

// Variable para controlar si el inicio de sesión fue exitoso
$loginCorrecto = false;

// Verifica si los campos 'usuario' y 'clave' fueron enviados en la petición POST
if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {
    echo "Recibidos datos de usuario y clave.<br>"; // Mensaje de depuración

    // Se establece la conexión a la base de datos utilizando la función conectarse()
    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);
    
    // Si la conexión falla, redirige al login con un mensaje de error
    if (!$conexion) {
        $_SESSION['error_message'] = "Error en la conexión a la base de datos.";
        header('Location: login.php');
        exit;
    }

    // Consulta SQL para buscar el usuario en la base de datos
    $sql = "SELECT nombre_usuario, id_usuario, pass FROM usuarios WHERE nombre_usuario = :usuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['usuario'], PDO::PARAM_STR);
    $stmt->execute();

    // Si el usuario existe, se procede a verificar la contraseña
    if ($reg = $stmt->fetch()) {
        echo "Usuario encontrado en la base de datos.<br>"; // Mensaje de depuración

        // Se verifica la contraseña ingresada con la almacenada en la base de datos
        if (password_verify($_POST['clave'], $reg['pass'])) {
            echo "Contraseña correcta.<br>"; // Mensaje de depuración

            // Inicia la sesión del usuario y almacena su ID y nombre de usuario en variables de sesión
            session_start();  
            $_SESSION['idusuario'] = $reg['id_usuario'];  
            $_SESSION['usuario'] = $reg['nombre_usuario']; 

            // Redirige al usuario a la página principal tras iniciar sesión correctamente
            header('Location: index.php');  
            exit;
        } else {
            // Si la contraseña es incorrecta, se muestra un mensaje de error y se redirige al login
            $_SESSION['error_message'] = "Usuario o Contraseña incorrectos.";
            header('Location: login.php');
            exit;
        }
    } else {
        // Si el usuario no existe en la base de datos, se muestra un mensaje de error
        $_SESSION['error_message'] = "Usuario o Contraseña incorrectos.";
        header('Location: login.php');
        exit;
    }
} else {
    // Si no se enviaron los datos completos, se muestra un mensaje de error
    $_SESSION['error_message'] = "Faltan datos en el formulario.";
    header('Location: login.php');
    exit;
}
?>
