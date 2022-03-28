<main class="contenedor contenido-centrado">
    <h1 data-cy="heading-admin" class="titulos">Administrador de bienes raíces</h1>

    <?php
    if ($mensaje) :  ?>
        <?php
        $notificacion = mostrarNotificacion(intval($mensaje));
        if ($notificacion) : ?>
            <p class="alerta exito"><?php echo s($notificacion);  ?></p>
    <?php endif;
    endif; ?>

    <div class="botones-formulario">
        <a href="/propiedades/crear" class="boton-verde">Nueva propiedad</a>
        <a href="/vendedores/crear" class=" boton-verde">Nuevo vendedor</a>
    </div>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- mostrar los resultados -->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la propiedad" class="imagen-tabla"> </td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id;  ?>" class="boton-verde-block">Actualizar</a>

                        <form method="POST" action="/propiedades/eliminar">
                            <!-- input que no es visible pero tiene el id que se va a eliminar -->
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- mostrar los resultados -->
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id;  ?>" class="boton-verde-block">Actualizar</a>

                        <form method="POST" action="/vendedores/eliminar">
                            <!-- input que no es visible pero tiene el id que se va a eliminar -->
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</main>