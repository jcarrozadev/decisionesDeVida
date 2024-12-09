let fila = 9; // Fila inicial de personaje
let columna = 6; // Columna inicial de personaje

// Inicializar personaje en la celda (9,6), abajo en el centro del mapa
document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`).innerHTML = '<img src="/img/personaje.png" class="personaje">';

// Agregar evento de clic a todas las celdas con la clase 'celdaMovimiento'
document.querySelectorAll('.celdaMovimiento').forEach(cell => {
    cell.addEventListener('click', function() {
        colocarPersonaje(this);
    });
});

function colocarPersonaje(cell) {
    // Obtener la fila y columna de la celda en la que se hizo clic
    const row = parseInt(cell.getAttribute('data-row'));
    const col = parseInt(cell.getAttribute('data-col'));

    // Verificar si la celda clicada es adyacente a la posición actual
    if (celdaCercana(row, col)) {
        // Limpiar todas las celdas excepto las que tienen la clase 'muerte-celda'
        document.querySelectorAll("td").forEach(td => {
            if (!td.classList.contains("muerte-celda")) {
                td.innerHTML = ""; // Eliminar el contenido de la celda
            }
        });

        // Colocar al personaje en la celda clicada
        cell.innerHTML = '<img src="/img/personaje.png" class="personaje">';

        // Actualizar la posición actual de personaje
        fila = row;
        columna = col;
    }
}

// Función que verifica si la celda clicada es adyacente a la actual
function celdaCercana(row, col) {
    // Verificar si la celda está en una fila o columna adyacente
    return Math.abs(row - fila) + Math.abs(col - columna) === 1;
}

// Agregar evento de teclado para mover el personaje con las teclas WASD
document.addEventListener('keydown', function(event) {
    let nuevaFila = fila;
    let nuevaColumna = columna;

    switch (event.key) {
        case 'w': // Mover hacia arriba
            nuevaFila = fila - 1;
            break;
        case 'a': // Mover hacia la izquierda
            nuevaColumna = columna - 1;
            break;
        case 's': // Mover hacia abajo
            nuevaFila = fila + 1;
            break;
        case 'd': // Mover hacia la derecha
            nuevaColumna = columna + 1;
            break;
        default:
            return; // Salir si no se presionó una tecla WASD
    }

    // Verificar si la nueva posición es válida y adyacente
    if (celdaCercana(nuevaFila, nuevaColumna)) {
        // Obtener la celda de la nueva posición
        const nuevaCelda = document.querySelector(`td[data-row='${nuevaFila}'][data-col='${nuevaColumna}']`);

        // Colocar al personaje en la nueva celda
        colocarPersonaje(nuevaCelda);
    }
});