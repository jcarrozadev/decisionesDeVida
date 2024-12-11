import { Mdialogo } from '../modelos/mDialogo.js';

export class Cdialogo {

    async altaDialogo(form) {

        console.log(form);
        const formData = new FormData(form);

        const mDialogo = new Mdialogo();
        let mensaje = mDialogo.altaDialogo(formData);

        return mensaje;
    }
}