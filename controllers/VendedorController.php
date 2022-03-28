<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{

    public static function crear(Router $router)
    {
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor();


        //Ejecutar el codigo sql despues de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vendedor = new Vendedor($_POST);

            //validad errores
            $errores = $vendedor->validarErrores();

            if (empty($errores)) {
               $resultado =  $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function actualizar(Router $router)
    {

        //validad errores
        $errores = Vendedor::getErrores();

        //validar id
        $id = validarORedirecconar('/admin');

        // obtener los datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);

        //Ejecutar el codigo sql despues de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //sincronizar objeto en memoria con lo que el usuario escribe
            $vendedor->sincronizar($_POST);

            $errores = $vendedor->validarErrores();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function eliminar(Router $router)
    {
    //    validar id
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        // validamos el tipo a eliminar
        $tipo = $_POST['tipo'];
    
        if (validarTipoContenido($tipo)) {
            $vendedor = Vendedor::find($id);
            $vendedor->eliminar();
        }
    }
    }
}
