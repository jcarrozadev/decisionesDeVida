import { Cdialogo } from '../controladores/dialogo.js';

let modal = document.getElementById('modal');

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formularioAltaDialogo');

    function validarDatos(datos) {
       
        if(!datos['nombreDialogo']) {
            modal.style.display = 'block';
            document.getElementById('tituloModal').innerHTML = 'Error';
            document.getElementById('mensajeModal').innerHTML = 'El campo nombre del diálogo es obligatorio.';
            return false;
        }

        if(datos['casilla']) {

            const casillaRegex = /^[A-J][1-9]$|^[A-J]1[0-2]$/;
            if (!casillaRegex.test(datos['casilla'])) {
                modal.style.display = 'block';
                document.getElementById('tituloModal').innerHTML = 'Error';
                document.getElementById('mensajeModal').innerHTML = 'La casilla debe ser una letra de la A a la J seguida de un número del 1 al 12.';
                return false;
            }

        }

        const selectedOption = form.listaNPC.options[form.listaNPC.selectedIndex];
        if (selectedOption.disabled) {
            modal.style.display = 'block';
            document.getElementById('tituloModal').innerHTML = 'Error';
            document.getElementById('mensajeModal').innerHTML = 'Debe seleccionar un NPC de la lista.';
            return false;
        }

        if(!datos['mensaje']) {
            modal.style.display = 'block';
            document.getElementById('tituloModal').innerHTML = 'Error';
            document.getElementById('mensajeModal').innerHTML = 'El campo mensaje es obligatorio.';
            return false;
        }

        if(!datos['respuesta1']) {
            modal.style.display = 'block';
            document.getElementById('tituloModal').innerHTML = 'Error';
            document.getElementById('mensajeModal').innerHTML = 'El campo respuesta 1 es obligatorio.';
            return false;
        }

        if(!datos['respuesta2']) {
            modal.style.display = 'block';
            document.getElementById('tituloModal').innerHTML = 'Error';
            document.getElementById('mensajeModal').innerHTML = 'El campo respuesta 2 es obligatorio.';
            return false;
        }

        return true;
    }


    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const datos = {
            nombreDialogo: form.nombreDialogo.value.trim(),
            casilla: form.casilla.value.trim(),
            listaNPC: form.listaNPC.value,
            mensaje: form.mensaje.value.trim(),
            respuesta1: form.respuesta1.value.trim(),
            respuesta2: form.respuesta2.value.trim()
        };

        if (!validarDatos(datos)) {
            return;
        }

        const dialogo = new Cdialogo();
        const mensaje = await dialogo.altaDialogo(form);

        modal.style.display = 'block';
        document.getElementById('tituloModal').innerHTML = 'Alta de diálogo';
        document.getElementById('mensajeModal').innerHTML = mensaje;

        window.location.href = 'index.php?c=dialogo&m=listarDialogos';
    });
});