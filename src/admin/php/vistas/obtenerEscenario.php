<!-- Javier Arias Carroza -->

<?php include 'php/vistas/assets/includes/header.php'; ?>
<style>
    form#dialogoForm {
        max-width: 600px;
        width: 40%;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: var(--color-azul);
    }

    form#dialogoForm h2 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff; /* Fondo blanco */
        color: #000; /* Texto negro */
    }

    .form-control option {
        background-color: #fff; /* Fondo blanco para opciones */
        color: #000; /* Texto negro */
    }

    .btn-submit {
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        background-color: var(--color-amarillo);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .btn-submit:hover {
        background-color: var(--color-amarillo-oscuro);
    }   
</style>
<form id="dialogoForm" enctype="multipart/form-data">
    <h2 style="text-align:center;">Alta de Diálogo</h2>
    <hr>
    <div class="form-group">
        <label for="listaNPC" class="form-label">Selecciona un Escenario:</label>
        <select name="listaNPC" id="listaNPC" class="form-control">
            <option hidden disabled selected>- Elige Escenario -</option>
            <?php

                $escenarios = $controlador->listarEscenarios();

                foreach ($escenarios as $escenario) {
                    echo "<option value='" . $escenario['idEscenario'] . "'>" . $escenario['nombreEscenario'] . "</option>";
                }

            ?>
        </select>
    </div>
    <button type="submit" class="btn-submit">Enviar</button>
</form>
<div style="text-align:center; margin-top: 20px; max-width: 600px; margin: 20px auto; width: 25%;">
    <a href="index.php" class="btn-submit" style="background-color: var(--color-amarillo); text-decoration:none;">Volver</a>
</div>

<?php include 'php/vistas/assets/includes/footer.php'; ?>
