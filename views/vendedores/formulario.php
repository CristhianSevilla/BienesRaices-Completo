<fieldset>
     <legend>Información general</legend>

     <label for="nombre">Nombre: </label>
     <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?php echo s($vendedor->nombre); ?>">

     <label for="apellido">Apellido: </label>
     <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" value="<?php echo s($vendedor->apellido); ?>">

     <label for="telefono">Teléfono: </label>
     <input type="number" id="telefono" name="telefono" placeholder="Tu telefono" value="<?php echo s($vendedor->telefono); ?>">
 </fieldset>