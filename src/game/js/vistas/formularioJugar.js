import {setCookie, getCookie} from "../vistas/cookies.js";

console.log(dineroConfig);

document.getElementById("formularioJugar").addEventListener("submit", function(event) {
    event.preventDefault();

    // No esta terminado, lo terminará al que le toque esta parte
    let nombreUsuario = document.getElementById("nombreUsuario").value;
    let personajeElegido = document.querySelector('input[name="personajeElegido"]:checked').value;

    
    let nombreUsuarioRegex = /^[a-zA-Z0-9_]{3,50}$/;
    if (!nombreUsuarioRegex.test(nombreUsuario)) { // Validaciones de que no puedan meter caracteres especiales
        alert("El nombre de usuario no es válido. Debe tener entre 3 y 50 caracteres y solo puede contener letras, números y guiones bajos.");
        return;
    }

    if (nombreUsuario && personajeElegido) {

        setCookie("nombreUsuario", nombreUsuario, 1);
        setCookie("personajeElegido", personajeElegido, 1);
<<<<<<< HEAD
        setCookie("tiempoTotal", "0", 1);
        setCookie("dineroTotal", "0", 1);
=======
        setCookie("tiempoTotal", String(tiempoConfig), 1); // Hay que pasarlo de numero a String
        setCookie("dineroTotal", String(dineroConfig), 1); // Hay que pasarlo de numero a String
>>>>>>> 05cb2095b34215f89c747f01f81e19e0760222f2

        location.href = "index.php?c=jugar&m=juego&iPrs=" + getCookie("personajeElegido") + "&nUsr=" + getCookie("nombreUsuario");
    } else {
        alert("Por favor, complete todos los campos.");
        location.reload();
    }

});