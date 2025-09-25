<?php
// Inicia la sesión para utilizar variables de sesión
session_start();

// Incluye los archivos externos de configuración y funciones adicionales
include('config.php');
include('lib.php');

// Inicializa una variable que indica si el registro se realizó correctamente (no utilizada después en este código)
$RegistroCorrecto = false;

// Función que valida el nombre del usuario mediante una expresión regular
function validarNombreUsuario($nombre) {
    if (preg_match('/^[a-zA-Z0-9_]{3,20}$/', $nombre)) {
        return true; // Nombre válido
    } else {
        return false; // Nombre inválido
    }
}

// Función que valida la contraseña (requiere al menos una minúscula, una mayúscula, un número y un carácter especial)
function validarContrasena($contrasena) {
    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $contrasena)) {
        return true; // Contraseña válida
    } else {
        return false; // Contraseña inválida
    }
}

// Función que valida el formato del correo electrónico
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Verifica si todos los campos necesarios del formulario han sido enviados
if (isset($_POST['usuario'], $_POST['pass'], $_POST['email'], $_POST['repetirpass'])) {

    // Valida los campos recibidos desde el formulario
    if (validarNombreUsuario($_POST['usuario']) && 
        validarContrasena($_POST['pass']) && 
        validarEmail($_POST['email']) && 
        $_POST['pass'] === $_POST['repetirpass']) {

        // Intenta realizar acciones en la base de datos dentro del bloque try-catch
        try {
            // Crea una conexión PDO utilizando los parámetros incluidos en config.php
            $conexion = new PDO($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);

            // Consulta SQL para verificar si el usuario o email ya existen en la base de datos
            $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = :usuario OR email = :email";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':usuario', $_POST['usuario'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->execute();
            $usuarioExistente = $stmt->fetchColumn();

            // Si el usuario o correo electrónico ya existen, redirige con mensaje de error
            if ($usuarioExistente) {
                $_SESSION['error_message'] = 'El usuario o correo electrónico ya están registrados.';
                header("Location: registro.php");
                exit;
            }

            // Si el usuario no existe, inserta los datos del nuevo usuario en la base de datos
            $sql = "INSERT INTO usuarios (nombre_usuario, pass, email, fecha_registro) VALUES (:usuario, :pass, :email, NOW())";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':usuario', $_POST['usuario'], PDO::PARAM_STR);

            // Cifra la contraseña utilizando password_hash antes de guardarla en la base de datos
            $hashedPass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $stmt->bindParam(':pass', $hashedPass, PDO::PARAM_STR);

            $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->execute();

            // Guarda en la sesión el usuario recién registrado para mantenerlo logueado
            $_SESSION['usuario'] = $_POST['usuario'];

            // Redirige al usuario a la página principal después del registro exitoso
            header("Location: index.php");
            exit;

        } catch (PDOException $e) {
            // Si ocurre un error en la conexión o consulta a la base de datos, redirige con mensaje de error
            $_SESSION['error_message'] = 'Error al intentar acceder a la base de datos: ' . $e->getMessage();
            header("Location: registro.php");
            exit;
        }

    } else {
        // Si la validación de campos falla, redirige con mensaje de error
        $_SESSION['error_message'] = 'Los datos proporcionados no son válidos. Por favor, intenta nuevamente.';
        header("Location: registro.php");
        exit;
    }
} else {
    // Si alguno de los campos necesarios no fue enviado, redirige con mensaje de error
    $_SESSION['error_message'] = 'Por favor, completa todos los campos del formulario.';
    header("Location: registro.php");
    exit;
}
?>
