// ✅ Se ejecuta la función `inicio` cuando la página ha cargado completamente
window.onload = inicio;

// Variables globales
var au; // Variable para el sonido
var activos = false; // Controla si la máquina está en uso
var numeros_actuales = []; // Almacena los números obtenidos en la jugada

// ✅ FUNCIÓN DE INICIALIZACIÓN
function inicio() {
    // Asigna eventos a los botones principales de la interfaz
    document.getElementById("tirar").onclick = lanzar_inicio; // Botón principal para jugar
    document.getElementById("cruz").onclick = cerrar; // Botón para cerrar un mensaje emergente

    // Obtiene el elemento de sonido de la página
    au = document.getElementById("sonido");

    // Obtiene todos los botones individuales de la máquina
    var botones = document.getElementsByClassName("boton");
    for (let i = 0; i < botones.length; i++) {
        botones[i].onclick = function () {
            lanzar_uno(i); // Permite lanzar una jugada específica por botón
        };
    }

    obtenerSaldo(); // 🔄 Obtiene el saldo del usuario al cargar la página
}

// ✅ OBTENER EL SALDO DEL USUARIO AL CARGAR O REFRESCAR LA PÁGINA
function obtenerSaldo() {
    $.ajax({
        url: "maquina_back.php", // Llama a la API del backend
        type: "POST", // Método de solicitud
        dataType: "json", // Espera una respuesta en formato JSON
        data: { action: "obtener_saldo" }, // Envia el parámetro "obtener_saldo" al servidor
        success: function (response) {
            if (response.success) {
                // Si el servidor responde correctamente, actualiza el saldo en la interfaz
                document.getElementById("dinero").textContent = response.saldo;
            } else {
                console.error("Error obteniendo saldo:", response.error);
            }
        }
    });
}

// ✅ INICIAR JUGADA PRINCIPAL
function lanzar_inicio() {
    // Verifica si el usuario tiene saldo suficiente antes de jugar
    if (parseInt(document.getElementById("dinero").textContent) > 0) {
        $.ajax({
            url: "maquina_back.php", // Envia la solicitud al backend
            type: "POST", // Método de envío
            dataType: "json", // Espera una respuesta JSON
            data: { action: "jugar" }, // Envia el parámetro "jugar" al backend
            success: function (response) {
                console.log(response); // 🔍 Muestra la respuesta en la consola para depuración
                if (response.success) {
                    actualizar_juego(response); // Actualiza la interfaz con los nuevos datos del servidor

                    // Si el usuario gana un premio, muestra un mensaje de alerta con la cantidad ganada
                    if (response.premio > 0) {
                        alert("¡Has ganado " + response.premio + " monedas!");
                    }
                } else {
                    console.error("Error jugando:", response.error);
                }
            }
        });
    }
}

// ✅ ACTUALIZAR EL JUEGO CON LOS NUEVOS DATOS DEL SERVIDOR
function actualizar_juego(response) {
    // Guarda los números obtenidos en la jugada en la variable global
    numeros_actuales = response.numeros_actuales;

    // Recorre las imágenes en la interfaz y las actualiza con los nuevos resultados del servidor
    for (let i = 0; i < numeros_actuales.length; i++) {
        document.getElementsByClassName("imagen")[i].getElementsByTagName("img")[0].src =
            "../imagenes/" + response.imagenes[numeros_actuales[i]];
    }

    // Actualiza el saldo del usuario en la interfaz después de la jugada
    document.getElementById("dinero").textContent = response.saldo;
}

// ✅ FUNCIÓN PARA CERRAR MENSAJES O PANTALLAS EMERGENTES
function cerrar() {
    document.getElementById("velo").style.display = "none"; // Oculta el mensaje emergente
    au.pause(); // Pausa el sonido asociado
}
