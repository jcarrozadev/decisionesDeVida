document.getElementById("formularioJugar").addEventListener("submit", function(event) {
    event.preventDefault();

    // No esta terminado, lo terminará al que le toque esta parte
    var nombreUsuario = document.getElementById("nombreUsuario").value;
    var personajeElegido = document.querySelector('input[name="personajeElegido"]:checked').value;

    if (nombreUsuario && personajeElegido) {
        location.href = "index.php?c=jugar&m=juego";
    } else {
        alert("Por favor, complete todos los campos.");
        location.reload();
    }

});