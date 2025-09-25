// Obtener los elementos del DOM con los IDs correctos
var usuarioInput = document.getElementById("usuario");
var emailInput = document.getElementById("email");
var passInput = document.getElementById("password");
var repetirPassInput = document.getElementById("repetirPassword");

// Expresiones regulares
const regexUsuario = /^[a-zA-Z0-9_]{3,20}$/;
const regexPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

// Función para validar usuario
function validarUsuario() {
    var usuario = usuarioInput.value.trim();
    if (regexUsuario.test(usuario)) {  
        // Si es válido, quitamos la clase "invalid" sin añadir "valid"
        usuarioInput.classList.remove("invalid");
        console.log("Usuario válido");
    } else {
        usuarioInput.classList.add("invalid");
        console.log("Formato de usuario incorrecto");
    }
}

// Función para validar email
function validarEmail() {
    var email = emailInput.value.trim();
    if (regexEmail.test(email)) {
        emailInput.classList.remove("invalid");
    } else {
        console.log("Email incorrecto");
        emailInput.classList.add("invalid");
    }
}

// Función para validar contraseña
function validarPass() {
    var pass = passInput.value;
    if (regexPass.test(pass)) {
        passInput.classList.remove("invalid");
    } else {
        console.log("Contraseña incorrecta");
        passInput.classList.add("invalid");
    }
}

// Función para comparar contraseñas
function compararPass() {
    var pass = passInput.value;
    var repetirPass = repetirPassInput.value;
    if (pass === repetirPass && pass !== "") {
        repetirPassInput.classList.remove("invalid");
    } else {
        console.log("Las contraseñas no coinciden");
        repetirPassInput.classList.add("invalid");
    }
}

// Validar en tiempo real (al salir del campo)
usuarioInput.addEventListener("blur", validarUsuario);
emailInput.addEventListener("blur", validarEmail);
passInput.addEventListener("blur", validarPass);
repetirPassInput.addEventListener("blur", compararPass);

// Validar al enviar el formulario
document.getElementById("container").addEventListener("submit", function(event) {
    // Ejecutar todas las validaciones
    validarUsuario();
    validarEmail();
    validarPass();
    compararPass();

    // Si algún campo tiene la clase "invalid", se evita el envío
    if (
        usuarioInput.classList.contains("invalid") ||
        emailInput.classList.contains("invalid") ||
        passInput.classList.contains("invalid") ||
        repetirPassInput.classList.contains("invalid")
    ) {
        event.preventDefault();
        alert("Por favor, corrige los errores en el formulario.");
    }
});
