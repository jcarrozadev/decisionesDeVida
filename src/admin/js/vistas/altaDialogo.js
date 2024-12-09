import { Cdialogo } from '../controladores/dialogo.js';

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formularioAltaDialogo');

    function validarDatos(datos) {
       
        if(!datos['nombreDialogo']) {
            alert('El campo nombre del diálogo es obligatorio.');
            return false;
        }

        if(!datos['casilla']) {
            alert('El campo casilla es obligatorio.');
            return false;
        }

        const casillaRegex = /^[A-J][1-9]$|^[A-J]1[0-2]$/;
        if (!casillaRegex.test(datos['casilla'])) {
            alert('La casilla debe ser una letra de la A a la J seguida de un número del 1 al 12.');
            return false;
        }

        const selectedOption = form.listaNPC.options[form.listaNPC.selectedIndex];
        if (selectedOption.disabled) {
            alert('Debe seleccionar un NPC de la lista.');
            return false;
        }

        if(!datos['mensaje']) {
            alert('El campo mensaje es obligatorio.');
            return false;
        }

        if(!datos['respuesta1']) {
            alert('El campo respuesta 1 es obligatorio.');
            return false;
        }

        if(!datos['respuesta2']) {
            alert('El campo respuesta 2 es obligatorio.');
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

        alert(mensaje);
    });
});