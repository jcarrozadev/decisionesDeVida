import {setCookie, getCookie} from "../vistas/cookies.js";

document.getElementById("formularioJugar").addEventListener("submit", function(event) {
    event.preventDefault();

    // No esta terminado, lo terminará al que le toque esta parte
    var nombreUsuario = document.getElementById("nombreUsuario").value;
    var personajeElegido = document.querySelector('input[name="personajeElegido"]:checked').value;

    if (nombreUsuario && personajeElegido) {

        setCookie("nombreUsuario", nombreUsuario, 1);
        setCookie("personajeElegido", personajeElegido, 1);
        setCookie("tiempoTotal", 0, 1);
        setCookie("dineroTotal", 0, 1);

        location.href = "index.php?c=jugar&m=juego&iPrs=" + getCookie("personajeElegido") + "&nUsr=" + getCookie("nombreUsuario");
    } else {
        alert("Por favor, complete todos los campos.");
        location.reload();
    }

});