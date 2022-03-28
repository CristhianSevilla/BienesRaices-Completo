<main class="contenedor seccion contenido-centrado">
      <h1 data-cy="heading-login" class="titulos">Iniciar sesión</h1>

      <?php
      foreach ($errores as $error) :;
      ?>
            <div data-cy="alerta-login" class="alerta error"><?php echo $error; ?></div>
      <?php endforeach; ?>

      <form data-cy="formulario-login" method="POST" class="formulario" action="/login">
            <fieldset>
                  <legend>Datos de usuario</legend>

                  <label for="email">E-mail</label>
                  <input data-cy="email-login" type="email" name="email" placeholder="E-mail" id="email">

                  <label for="password">Password</label>
                  <input data-cy="password-login" type="password" name="password" placeholder="Password" id="password">

                  <div class="alinear-derecha">
                        <input type="submit" value="Iniciar Sesión" class="boton-verde">
                  </div>
            </fieldset>
      </form>

</main>