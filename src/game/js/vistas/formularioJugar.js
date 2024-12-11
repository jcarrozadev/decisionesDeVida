document.getElementById("formularioJugar").addEventListener("submit", function(event) {
    event.preventDefault();

    // No esta terminado, lo terminará al que le toque esta parte
    
    location.href = "index.php?c=jugar&m=juego";

});