export class Mdialogo {

    async altaDialogo(formData) {

        console.log(formData);
        try {
            const response = await fetch('index.php?c=dialogo&m=altaDialogo', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Hubo un error al dar de alta el dialogo');
            }

            const data = await response.text();
            return data;
        } catch (error) {
            alert(error);
        }

    }
}