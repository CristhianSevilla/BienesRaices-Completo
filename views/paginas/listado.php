<div class="contenedor-anuncios">
    <!-- mostrar resultado -->
    <?php foreach ($propiedades as $propiedad): ?>
        <div class="anuncio" data-cy="anuncio">
            <div class="imagen-anuncio">
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio1">
            </div>
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->descripcion; ?></p>
                <p class="precio">$ <?php echo $propiedad->precio; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" src="build/img/icono_wc.svg" alt="Icono WCs">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>
                <a data-cy="enlace-propiedad" class="boton-amarillo" href="/propiedad?id=<?php echo $propiedad->id; ?>">Ver Propiedad</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>