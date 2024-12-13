// COLISIONES

const casillasColision = window.colisiones.map(colision => colision.casilla);
console.log(casillasColision);

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
        cell.innerHTML = `<img src="${sprite}" class="personaje" style="width: 41px;">`;

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

    mover(movimiento);
});

function moverTablet(direccion) {
    const movimiento = movimientos[direccion];

    mover(movimiento);

}

function validarMovimientoColision(movimiento) {
    const nuevaFila = fila + movimiento.fila;
    const nuevaColumna = columna + movimiento.columna;

    // Convertir la fila de número a letra (1 -> A, 2 -> B, ..., 9 -> I)
    const filaLetra = String.fromCharCode(64 + nuevaFila);
    // Verificar si la nueva posición está en las casillas de colisión
    const colision = verificarCasillaColision(filaLetra, nuevaColumna);
    return !colision;
}

function verificarCasillaColision(fila, columna) {
    return casillasColision.some(casilla => {
        return casilla == `${fila}${columna}`;
    });
}

function mover(movimiento) {
    if (!movimiento) 
        return; //Movimiento no válido
    
    const nuevaFila = fila + movimiento.fila;
    const nuevaColumna = columna + movimiento.columna;
    const nuevoSprite = movimiento.sprite;

    if(!validarMovimientoColision(movimiento)) {
        console.log("Colisión detectada");
        const celdaActual = document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`);
        celdaActual.innerHTML = `<img src="${nuevoSprite}" class="personaje" style="width: 41px;">`;
        return; //Movimiento no válido
    }

    // AQUI IRIA LA VALIDACION DE SI HAY UN DIALOGO, SI HAY UN DIALOGO LO QUE DEBERIA DE HACER ES MIRAR AL NPC Y NO MOVERSE, Y QUE SALTE EL MODAL DEL DIALOGO

    if (celdaCercana(nuevaFila, nuevaColumna)) {

        const nuevaCelda = document.querySelector(`td[data-row='${nuevaFila}'][data-col='${nuevaColumna}']`);

        colocarPersonaje(nuevaCelda, nuevoSprite);

        fila = nuevaFila;
        columna = nuevaColumna; 
    }
}