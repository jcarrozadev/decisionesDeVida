import {setCookie, getCookie} from "../vistas/cookies.js";

// COLISIONES

const casillasColision = window.colisiones.map(colision => colision.casilla);
// console.log(casillasColision);

const dialogosArray = Object.keys(dialogos).map(key => dialogos[key]);
// const dialogos = window.dialogos.map(dialogo => dialogo.casilla);

const casillasDialogos = dialogosArray
    .filter(dialogo => dialogo.casilla !== null)
    .map(dialogo => dialogo.casilla);

colocarDialogos(dialogosArray);

function colocarDialogos(dialogosArray) {
    dialogosArray.forEach(dialogo => {
        
        // Comprobamos que el dialogo tenga una casilla buscando el npc
        if(dialogo.npc) {
            
            const fila = dialogo.casilla.charCodeAt(0) - 64; // Convertir letra a número (A -> 1, B -> 2, ..., J -> 10)
            const columna = parseInt(dialogo.casilla.slice(1)); // Obtener el número de la columna

            if (fila != 1) { //Celda de arriba parpadeante con la flecha
                const celdaSeleccionada = document.querySelector(`td[data-row='${fila - 1}'][data-col='${columna}']`);

                celdaSeleccionada.innerHTML = `<i class="fas fa-arrow-down"></i>`;
                celdaSeleccionada.classList.add("parpadea");
                celdaSeleccionada.setAttribute("data-dialogo", dialogo.idDialogo);

                casillasColision.push(`${String.fromCharCode(64 + fila - 1)}${columna}`); //Agrega colisión
            }

            const celda = document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`);
            celda.classList.add("celdaSeleccionada");

            celda.innerHTML = `<img src="${dialogo.npc.sprite}" class="personaje" style="width: 41px;">`;
            celda.setAttribute("data-dialogo", dialogo.idDialogo);

        }
    });
}

// Modifica las funciones donde se coloca al personaje para que también usen el sprite dinámico
function colocarPersonaje(cell, sprite) {
    const row = parseInt(cell.getAttribute('data-row'));
    const col = parseInt(cell.getAttribute('data-col'));

    // Eliminar el contenido de las celdas que no sean dialogos
    document.querySelectorAll("td").forEach(td => {
        if (!td.hasAttribute("data-dialogo")) {
            td.innerHTML = ""; // Eliminar el contenido de la celda
        }
    });

    // Colocar al personaje en la celda clicada con el sprite correspondiente
    cell.innerHTML = `<img src="${sprite}" class="personaje" style="width: 41px;">`;

    fila = row;
    columna = col;
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

function validarMovimientoDialogo(movimiento) {
    const nuevaFila = fila + movimiento.fila;
    const nuevaColumna = columna + movimiento.columna;

    // Convertir la fila de número a letra (1 -> A, 2 -> B, ..., 9 -> I)
    const filaLetra = String.fromCharCode(64 + nuevaFila);
    // Verificar si la nueva posición está en las casillas de colisión
    const colision = validarCasillaDialogo(filaLetra, nuevaColumna);
    return !colision;
}

function validarCasillaDialogo(fila, columna) {
    return casillasDialogos.some(casilla => {
        return casilla == `${fila}${columna}`;
    });
}

function mover(movimiento) {
    if (!movimiento) 
        return; //Movimiento no válido
    
    const nuevaFila = fila + movimiento.fila;
    const nuevaColumna = columna + movimiento.columna;
    const nuevoSprite = movimiento.sprite;

    // Validamos si el movimiento se sale de la tabla
    if(nuevaFila < 1 || nuevaFila > 9 || nuevaColumna < 1 || nuevaColumna > 12) {
        return; //Movimiento no válido
    }

    if(!validarMovimientoColision(movimiento)) {
        console.log("Colisión detectada");
        const celdaActual = document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`);
        celdaActual.innerHTML = `<img src="${nuevoSprite}" class="personaje" style="width: 41px;">`;
        return; //Movimiento no válido
    }


    if(!validarMovimientoDialogo(movimiento)) {
        console.log("Dialogo detectado");

        const celdaActual = document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`);
        celdaActual.innerHTML = `<img src="${nuevoSprite}" class="personaje" style="width: 41px;">`;

        const dialogoId = document.querySelector(`td[data-row='${nuevaFila}'][data-col='${nuevaColumna}']`).getAttribute("data-dialogo");

        const dialogo = dialogosArray.find(dialogo => dialogo.idDialogo == dialogoId);

        // console.log(dialogo);

        if (dialogo) {
            
            console.log(dialogo);

            document.getElementById("mensajeDialogo").innerText = dialogo.mensaje;
            document.getElementById("respuesta1Dialogo").innerText = dialogo.respuestas.rp1Mensaje;
            document.getElementById("respuesta2Dialogo").innerText = dialogo.respuestas.rp2Mensaje;

            document.getElementById("dialogo").style.display = "block";

            document.getElementById("respuesta1Dialogo").onclick = function() {
                
                if(dialogo.respuestas.rp1Dialogo) {

                    alert("TIENE ACCION A OTRO DIALOGO");

                }
                
                if(dialogo.respuestas.rp1Escenario != null) {

                    location.href =
                        "index.php?c=jugar&m=juego&iPrs="
                        + getCookie("personajeElegido")
                        + "&nUsr=" + getCookie("nombreUsuario")
                        + "&idEsc=" + dialogo.respuestas.rp1Escenario;

                }


                document.getElementById("dialogo").style.display = "none";
            };

            document.getElementById("respuesta2Dialogo").onclick = function() {
                
                if(dialogo.respuestas.rp2Dialogo) {

                    alert("TIENE ACCION A OTRO DIALOGO");

                }
                
                if(dialogo.respuestas.rp2Escenario != null) {

                    location.href = "index.php?c=jugar&m=juego&iPrs="
                    + getCookie("personajeElegido")
                    + "&nUsr="+ getCookie("nombreUsuario")
                    + "&idEsc=" + dialogo.respuestas.rp2Escenario;

                }


                document.getElementById("dialogo").style.display = "none";
            };


        } else {
            console.error("Diálogo no encontrado");
        }
        
        return; //Movimiento no válido
    }

    if (celdaCercana(nuevaFila, nuevaColumna)) {

        const nuevaCelda = document.querySelector(`td[data-row='${nuevaFila}'][data-col='${nuevaColumna}']`);

        colocarPersonaje(nuevaCelda, nuevoSprite);

        fila = nuevaFila;
        columna = nuevaColumna; 
    }
}