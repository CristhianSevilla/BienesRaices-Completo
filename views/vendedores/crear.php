<main class="contenedor contenido-centrado">
    <h1 class="titulos">Registrar Vendedor(a)</h1>

    <!-- imprimir errores -->
    <?php foreach ($errores as $error) :  ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form action="/vendedores/crear" class="formulario" method="POST">

        <?php include 'formulario.php'; ?>

        <div class="botones-formulario">
            <a href="/admin/" class="boton boton-verde">Regresar</a>
            <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </div>
    </form>
</main>