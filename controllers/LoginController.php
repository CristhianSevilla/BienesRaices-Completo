<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{

    public static function login(Router $router)
    {

        // $password = "123456";

        // $passwordHash=password_hash($password, PASSWORD_BCRYPT);

        // debuguear($passwordHash);

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if (empty($errores)) {
                //Validar que el usuario exista
                $resultado =  $auth->existeUsuario();

                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    //Validar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                    //Autenticar al usuario
                        $auth->autenticar();
                    }else{
                        //Password incorrecto mensaje de error
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout()
    {
        session_start();

        $_SESSION = []; //borramos datos de sesion

        header('Location: /');
    }
}
