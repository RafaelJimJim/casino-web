// Evento que se dispara cuando la página ha cargado completamente
document.addEventListener("DOMContentLoaded", function () {

    // Comprobamos si el usuario ya ha aceptado previamente el disclaimer (confirmación de edad)
    if (localStorage.getItem("disclaimerAceptado")) {
        // Si lo aceptó anteriormente, ocultamos el modal automáticamente
        document.getElementById("disclaimer-modal").style.display = "none";
    }

    // Añadimos evento al botón "aceptar" del modal de disclaimer
    document.getElementById("aceptar-btn").addEventListener("click", function () {
        // Guardamos en localStorage que el usuario aceptó el disclaimer
        localStorage.setItem("disclaimerAceptado", "true");
        // Ocultamos el modal de disclaimer después de aceptar
        document.getElementById("disclaimer-modal").style.display = "none";
    });

    // Evento para cuando el usuario hace clic en el botón de rechazo (si existiera)
    document.getElementById("rechazar-btn").addEventListener("click", function () {
        // Si el usuario no acepta, se redirige a otra página (por ejemplo, fuera del sitio)
        window.location.href = "https://www.google.com";
    });
});
