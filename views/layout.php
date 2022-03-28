<?php
// revisa si ya esta arracada la sesion si no entonces la arranca
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

if(!isset($inicio)) {
    $inicio = false;
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>

    <link rel="stylesheet" href="/build/css/app.css">

</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <div class="barra-menu-hamburguesa">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt="Logotipo de bienes raices">
                    </a>

                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="icono menú responsive">
                    </div>
                </div>
                <nav  data-cy="navegación-header" class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Propiedades</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                    <?php if ($auth) : ?>
                        <a href="/logout">Cerrar sesión</a>
                    <?php endif ?>
                </nav>
            </div>
            <?php echo $inicio ? '  <div class="header-inferior">
                <h1 data-cy="heading-sitio">Venta de casas y departamentos exclusivos de lujo</h1>
            </div>' : ''; ?>
        </div>
    </header>
    <div class="contenedor-btn-nocturno modo-nocturno">
        <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Icono Dark Mode" title="Activar Modo Nocturno">
    </div>

    <?php echo $contenido ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav data-cy="navegación-footer" class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Propiedades</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>
        <p data-cy="copyright" class="copyright"> <?php echo date('Y') ?> &copy Todos los derechos reservados by Crishian Sevilla</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
</body>

</html>