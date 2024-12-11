let fila = 9; // Fila inicial de personaje
let columna = 6; // Columna inicial de personaje

// Inicializar personaje en la celda (9,6), abajo en el centro del mapa
document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`).innerHTML = `<img src="${sprites.front}" class="personaje" style="width: 46px;">`;

// Agregar evento de clic a todas las celdas con la clase 'celdaMovimiento'
/*document.querySelectorAll('.celdaMovimiento').forEach(cell => {
    cell.addEventListener('click', function() {
        colocarPersonaje(this);
    });
});*/

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

/************************************************ FUNCIONES ************************************************/

const movimientos = {
    'w': { fila: -1, columna: 0, sprite: sprites.back }, // Arriba
    'a': { fila: 0, columna: -1, sprite: sprites.left }, // Izquierda
    's': { fila: 1, columna: 0, sprite: sprites.front }, // Abajo
    'd': { fila: 0, columna: 1, sprite: sprites.right }  // Derecha
};

document.addEventListener('keydown', function(event) {
    const movimiento = movimientos[event.key];

    // Si no es una tecla válida, salir
    if (!movimiento) return;

    // Nuevas coordenadas y el sprite
    const nuevaFila = fila + movimiento.fila;
    const nuevaColumna = columna + movimiento.columna;
    const nuevoSprite = movimiento.sprite;

    // Verificar si la nueva posición es válida y adyacente
    if (celdaCercana(nuevaFila, nuevaColumna)) {
        // Obtener la celda de la nueva posición
        const nuevaCelda = document.querySelector(`td[data-row='${nuevaFila}'][data-col='${nuevaColumna}']`);

        // Colocar al personaje en la nueva celda con el sprite correcto
        colocarPersonaje(nuevaCelda, nuevoSprite);

        // Actualizar las variables globales de posición
        fila = nuevaFila;
        columna = nuevaColumna;
    }
});
