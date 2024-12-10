let fila = 9; // Fila inicial de personaje
let columna = 6; // Columna inicial de personaje

// Inicializar personaje en la celda (9,6), abajo en el centro del mapa
document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`).innerHTML = `<img src="${sprites.front}" class="personaje" style="width: 46px;">`;

// Agregar evento de clic a todas las celdas con la clase 'celdaMovimiento'
document.querySelectorAll('.celdaMovimiento').forEach(cell => {
    cell.addEventListener('click', function() {
        colocarPersonaje(this);
    });
});

// Modifica las funciones donde se coloca al personaje para que también usen el sprite dinámico
function colocarPersonaje(cell, sprite) {
    const row = parseInt(cell.getAttribute('data-row'));
    const col = parseInt(cell.getAttribute('data-col'));

    if (celdaCercana(row, col)) {
        document.querySelectorAll("td").forEach(td => {
            if (!td.classList.contains("muerte-celda")) {
                td.innerHTML = ""; // Eliminar el contenido de la celda
            }
        });

        // Colocar al personaje en la celda clicada con el sprite correspondiente
        cell.innerHTML = `<img src="${sprite}" class="personaje" style="width: 46px;">`;

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
    let nuevoSprite = sprites.front;  // Direccion por defecto (frente)

    switch (event.key) {
        case 'w': // Mover hacia arriba
            nuevaFila = fila - 1;
            nuevoSprite = sprites.back; // Cambiar sprite a 'back' para moverse hacia arriba
            break;
        case 'a': // Mover hacia la izquierda
            nuevaColumna = columna - 1;
            nuevoSprite = sprites.left; // Cambiar sprite a 'left' para moverse hacia la izquierda
            break;
        case 's': // Mover hacia abajo
            nuevaFila = fila + 1;
            nuevoSprite = sprites.front; // Cambiar sprite a 'front' para moverse hacia abajo
            break;
        case 'd': // Mover hacia la derecha
            nuevaColumna = columna + 1;
            nuevoSprite = sprites.right; // Cambiar sprite a 'right' para moverse hacia la derecha
            break;
        default:
            return; // Salir si no se presionó una tecla WASD
    }

    // Verificar si la nueva posición es válida y adyacente
    if (celdaCercana(nuevaFila, nuevaColumna)) {
        // Obtener la celda de la nueva posición
        const nuevaCelda = document.querySelector(`td[data-row='${nuevaFila}'][data-col='${nuevaColumna}']`);

        // Colocar al personaje en la nueva celda con el sprite correcto
        colocarPersonaje(nuevaCelda, nuevoSprite);
    }
});
