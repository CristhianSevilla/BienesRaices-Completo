<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    //Todas las url que reacionan a un metódo GET, recibe la ur actual y el metodo a ejecutar
    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();

        $auth = $_SESSION['login'] ?? null;

        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/vendedores/crear', '/propiedades/actualizar', '/admin/', '/propiedades/eliminar', '/vendedores/actualizar', '/vendedores/eliminar'];

        //leer url actual

        $urlActual = ($_SERVER['REQUEST_URI'] === '') ? '/' :  $_SERVER['REQUEST_URI'];

        //obtener metodo que se usa (GET o POST)
        $metodo = $_SERVER['REQUEST_METHOD'];

        //dividimos la URL actual cada vez que exista un '?' eso indica que se están pasando variables por la url
        $splitURL = explode('?', $urlActual);

        if ($metodo === 'GET') {
            //obtenemos la funcion de la url 
            $fn =  $this->rutasGET[$splitURL[0]] ?? null;//$splitURL[0] contiene la URL sin variables 
        } else {
            $fn =  $this->rutasPOST[$splitURL[0]] ?? null;
        }

        //proteger las rutas 
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header("Location: /");
        }


        if ($fn) {

            //La URL existe y hay una funcion asociada a ella
            //call_user_func permite llamar una funcion cuanod no sabemos como se lla esa funcion
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }

    //mostrar una vista
    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        //inicar un alamcenamiento en memoria
        ob_start();
        include  __DIR__ . "/views/$view.php";

        //limpiamos memoria
        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}
