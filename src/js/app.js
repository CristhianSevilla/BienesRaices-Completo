document.addEventListener('DOMContentLoaded', function() {

    eventListener();
    darkMode();
});

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
        nav
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    })
}

function eventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegaciónResponsive);

    //Muestra campos condicionales del formulario de conrtacto

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    //recoorer las opciones y agregar una evento
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodoContacto));

}


function navegaciónResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
    //El código de arriba hace lo mismo del if else de abajo
    // if (navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar');
    // } else {
    //     navegacion.classList.add('mostrar');
    // }
}

document.addEventListener('DOMContentLoaded', function() {
    mensajesTime();
});

function mensajesTime() {
    if (document.querySelector('.alerta')) {
        //Eliminar texto de confirmación de CRUD en admin/index.php
        setInterval(function() {
            const mensajeConfirm = document.querySelector('.alerta');
            const padre = mensajeConfirm.parentElement;
            padre.removeChild(mensajeConfirm);
        }, 5000);
    }
}

function mostrarMetodoContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <input data-cy="input-telefono" type="tel" placeholder="Teléfono" id="telefono" name="contacto[telefono]">

        <label>Selleccione fecha y hora</label>

        <label for="fecha">Fecha:</label>
        <input data-cy="input-fecha" type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input data-cy="input-hora" type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <input data-cy="input-email" type="email" placeholder="E-mail" id="email" name="contacto[email]" required>
        `;
    }
    console.log(e)
}