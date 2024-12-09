let fila = 9; // Fila inicial de Charmander
let columna = 6; // Columna inicial de Charmander

// Inicializar Charmander en la celda (9,6), abajo en el centro del mapa
document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`).innerHTML = '<img src="/img/charmander.png" class="charmander">';

// Agregar evento de clic a todas las celdas con la clase 'celdaMovimiento'
document.querySelectorAll('.celdaMovimiento').forEach(cell => {
    cell.addEventListener('click', function() {
        colocarCharmander(this);
    });
});

function colocarCharmander(cell) {
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

        // Colocar a Charmander en la nueva celda
        cell.innerHTML = '<img src="/img/charmander.png" class="charmander">';
        // Actualizar la posición actual de Charmander
        fila = row;
        columna = col;
    }
}

// Función que verifica si la celda clicada es adyacente a la actual
function celdaCercana(row, col) {
    // Verificar si la celda está en una fila o columna adyacente
    return Math.abs(row - fila) + Math.abs(col - columna) === 1;
}

