<main class="contenedor contenido-centrado">
    <h1 data-cy="heading-contacto" class="titulos">Contacto</h1>

    <?php
        if ($mensaje) {
            echo "<p data-cy='alerta-envio-formulario' class='alerta exito'>" . $mensaje . "</p>";
        }
    ?>
    
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>

    <h2 data-cy="heading-formulario">LLene el formulario de contacto</h2>
    <form data-cy="formulario-contato" action="/contacto" class="formulario" method="POST">
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre</label>
            <input  data-cy="input-nombre" required type="text" placeholder="Nombre" id="nombre" name="contacto[nombre]">

            <label for="mensaje">Mensaje</label>
            <textarea data-cy="input-mensaje" id="mensaje" name="contacto[mensaje]" required></textarea>

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">¿Vende o compra?</label>
            <select data-cy="input-opciones" id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Compra">Comprar</option>
                <option value="Vende">Vender</option>
            </select>
            <label for="presupuesto">Precio o presupuesto</label>
            <input data-cy="input-precio" type="number" placeholder="Presupuesto/Precio" id="presupuesto" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <label>¿Cómo desea ser contactado?</label>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input data-cy="forma-contacto" type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                <label for="contactar-email">E-mail</label>
                <input data-cy="forma-contacto" type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>

            <div id="contacto"></div>
        </fieldset>

        <div class="alinear-derecha">
        <input type="submit" value="Enviar" class="boton-verde">
        </div>
    </form>
</main>