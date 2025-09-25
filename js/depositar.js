// Función para obtener y actualizar el saldo actual del usuario
function actualizarSaldo() {
    $.ajax({
        url: 'depositar.php',  // Realiza una solicitud GET a depositar.php para obtener el saldo
        type: 'GET',
        dataType: 'json',  // Espera recibir una respuesta en formato JSON
        success: function(response) {
            if (response.saldo !== undefined) {
                // Actualiza el saldo en los elementos con id "saldo-actual" y "dinero"
                $("#saldo-actual, #dinero").text(response.saldo + "€");
                console.log("✅ Saldo actualizado:", response.saldo);
            } else if (response.error) {
                console.error("❌ Error:", response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error("❌ Error en la solicitud:", error);
        }
    });
}

// Función para realizar un depósito de saldo
function depositar() {
    console.log("✅ Función depositar llamada");
    $.ajax({
        url: 'depositar.php',  // Realiza una solicitud POST a depositar.php para depositar dinero
        type: 'POST',
        dataType: 'json',  // Espera recibir una respuesta en formato JSON
        data: { depositar: 'true' },  // Envía el parámetro "depositar" con el valor "true"
        success: function(response) {
            console.log("🔄 Respuesta recibida del servidor:", response);
            if (response.success && response.total_saldo !== undefined) {
                // Si el depósito es exitoso, actualiza el saldo en la interfaz
                $("#saldo-actual, #dinero").text(response.total_saldo + "€");
                console.log("✅ Saldo actualizado:", response.total_saldo);
            } else if (response.error) {
                console.error("❌ Error:", response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error("❌ Error en la solicitud:", error);
        }
    });
}

// Espera a que el documento HTML esté completamente cargado
$(document).ready(function() {
    // Llama a la función para actualizar el saldo al cargar la página
    actualizarSaldo();

    // Asigna un evento al botón con id "btnDepositar" para ejecutar la función depositar() cuando se haga clic
    $("#btnDepositar").on("click", function(event) {
        event.preventDefault();  // Previene el comportamiento por defecto del botón
        depositar();
    });
});
