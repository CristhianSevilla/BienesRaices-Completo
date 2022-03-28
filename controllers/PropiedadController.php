<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class PropiedadController
{
    public static function index(Router $router)
    {
        //trae todas las propiedades o vendedores de la bd
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        //muestra mensaje condicional, ?? si no existe resultado en la url le asigna null
        $mensaje = $_GET['mensaje'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'mensaje' => $mensaje,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        //validamos errores
        $errores = Propiedad::getErrores();

        //Ejecutar el codigo sql despues de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //instanciamos la clase propiedad
            $propiedad = new Propiedad($_POST);

            //si el usuario proporciono una imagen
            if ($_FILES['imagen']['tmp_name']) {
                //generar un nombre unico para la imagen, md5 genera una cadena siempre igual y uniqid hace la cadena unica 
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                //Asignar files hacia una variable
                $image = $_FILES['imagen'];

                //Validar tamaño de las imagenes(1mg max)
                $medida = 1000 * 1000;
                if ($image['size'] < $medida) {
                    //Mandamos el nombre de la imagen que se guardara en la BD al objeto propiedad
                    $propiedad->setImagen($nombreImagen);
                }
            }

            //validad errores
            $errores = $propiedad->validarErrores();

            //revisar que el arreglo de errores este vacio
            if (empty($errores)) {

                //creamos la carpeta donde se subiran las imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                //Subir la imagen al servidor
                move_uploaded_file($image['tmp_name'], CARPETA_IMAGENES . $nombreImagen);

                //guardar en la DB
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', ['propiedad' => $propiedad, 'vendedores' => $vendedores, 'errores' => $errores]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedirecconar('/admin');

        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        //Ejecuta el codigo sql despues de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //sinconizar datos de usuario con datos de la base
            $propiedad->sincronizar($_POST);

            $errores = $propiedad->validarErrores();

            //si el usuario proporciono una imagen
            if ($_FILES['imagen']['tmp_name']) {
                //generar un nombre unico para la imagen, md5 genera una cadena siempre igual y uniqid hace la cadena unica 
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                //Asignar files hacia una variable
                $image = $_FILES['imagen'];

                //Validar tamaño de las imagenes(1mg max)
                $medida = 1000 * 1000;
                if ($image['size'] < $medida) {
                    //Mandamos el nombre de la imagen que se guardara en la BD al objeto propiedad
                    $propiedad->setImagen($nombreImagen);
                }
            }

            //revisar que el arreglo de errores este vacio
            if (empty($errores)) {

                if ($_FILES['imagen']['tmp_name']) {
                    //Subir la imagen al servidor
                    move_uploaded_file($image['tmp_name'], CARPETA_IMAGENES . $nombreImagen);
                }
                //actualizar propiedad
                $propiedad->guardar();
            }
        }


        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            //validamos que sea un id valido
            $id = filter_var($id, FILTER_VALIDATE_INT);

            //Si pasa el filtro
            if ($id) {
                $tipo  = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
