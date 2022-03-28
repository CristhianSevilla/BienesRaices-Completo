<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render(
            'paginas/propiedades',
            [
                'propiedades' => $propiedades
            ]
        );
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedirecconar('/propiedades');

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);

        if (!$propiedad == NUll) { //Valida que exista en la DB
            $router->render('paginas/propiedad', [
                'propiedad' => $propiedad
            ]);
        } else {
            header("Location: /propiedades ");
        }
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Capturar informacion del formulario
            $respuestas = $_POST['contacto'];

            //Instanciar PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP (Protocolo para encio de email)
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username =  'ac67e8e7b2dd63';
            $mail->Password = '1e867ace4a2362';
            $mail->SMTPSecure = 'tls'; //no encripatdos pero van por un tunel seguro
            $mail->Port = 2525;

            //configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com'); //quien envia el correo
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); //quien lo recibe
            $mail->Subject = '¡Tienes Un Nuevo Mensaje!';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Defiir el contenido
            $contenido = '<html>';
            $contenido .= '<p>!Tienes Un Nuevo Mensaje!</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';

            //Enviar de forma condicional algunos campos de email o telefono

            if ($respuestas['contacto'] === 'telefono') {

                $contenido .= '<p>Eligio ser contactado por teléfono</p>';

                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';

                $contenido .= '<p>Fecha para contactar: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';

            } else {

                $contenido .= '<p>Eligio ser contactado por correo</p>';

                $contenido .= '<p>Correo: ' . $respuestas['email'] . '</p>';
            }




            $contenido .= '<p>¿Compra o Vende?: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o presupuesto: $' . $respuestas['precio'] . '</p>';
 
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo son html';


            //Enviar email
            if ($mail->send()) { //revisa que el emil se envie (true o false)
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mesaje = 'El mensaje no se pudo enviar';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje'=> $mensaje
        ]);
    }
}
