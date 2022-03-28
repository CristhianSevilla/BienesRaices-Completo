<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    //atributos
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    //constructor
    function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

     //Validacion de formulario (errores)
     public function validarErrores()
     {
 
         if (!$this->nombre) {
             self::$errores[] = "El nombre es obligatorio";
         }
 
         if (!$this->apellido) {
             self::$errores[] = "El apellido es obligatorio";
         }
 
         if (!$this->telefono) {
             self::$errores[] = "El telefono es obligatorio";
         }

         if (!preg_match('/[0-9]{10}/', $this->telefono)) {
             self::$errores[] = "Ingresa un télfono valido";
         }
 
         return self::$errores;
     }
}
