// ✅ Variable global que almacena el número de la página actual
var pagina = 1;

/**
 * ✅ FUNCIÓN PARA CARGAR EL HISTORIAL DE JUGADAS SEGÚN LA PÁGINA SOLICITADA
 */
function cargarJugadas(pagina) {
    $.ajax({
        url: "perfil_back.php", // Se envía la solicitud al backend para obtener las jugadas
        type: "GET", // Método GET para solicitar datos
        data: { pagina: pagina }, // Envia el número de la página como parámetro
        dataType: "json", // Se espera una respuesta en formato JSON
        success: function(response) {
            // ✅ Vaciar la tabla antes de insertar nuevas filas
            $("#jugadas-table").html("");

            // ✅ Recorrer cada jugada obtenida y agregarla a la tabla
            response.jugadas.forEach(jugada => {
                let tipo = jugada.procedencia_saldo == 1 ? "Premio" : "Depósito"; // Determina si es un premio o un depósito
                $("#jugadas-table").append(`
                    <tr>
                        <td>${jugada.fecha}</td> <!-- Columna con la fecha -->
                        <td>${jugada.saldo}€</td> <!-- Columna con el saldo obtenido -->
                        <td>${tipo}</td> <!-- Columna con el tipo de jugada -->
                    </tr>
                `);
            });

            // ✅ ACTUALIZAR EL TEXTO DE PAGINACIÓN
            $("#paginaActual").text(`Página ${response.pagina_actual} de ${response.total_paginas}`);

            // ✅ Habilitar o deshabilitar botones de paginación según la página actual
            $("#btnAnterior").prop("disabled", response.pagina_actual == 1); // Deshabilita si está en la primera página
            $("#btnSiguiente").prop("disabled", response.pagina_actual == response.total_paginas); // Deshabilita si está en la última página
        }
    });
}

// ✅ BOTÓN "ANTERIOR": DISMINUYE EL NÚMERO DE PÁGINA SI NO ESTÁ EN LA PRIMERA
$("#btnAnterior").click(() => {
    if (pagina > 1) {
        pagina--; // Resta una página
        cargarJugadas(pagina); // Recarga los datos con la nueva página
    }
});

// ✅ BOTÓN "SIGUIENTE": AUMENTA EL NÚMERO DE PÁGINA SI NO ESTÁ EN LA ÚLTIMA
$("#btnSiguiente").click(() => {
    pagina++; // Suma una página
    cargarJugadas(pagina); // Recarga los datos con la nueva página
});

// ✅ CUANDO EL DOCUMENTO ESTÉ LISTO, CARGA LAS JUGADAS DE LA PRIMERA PÁGINA
$(document).ready(() => {
    cargarJugadas(pagina);
});
