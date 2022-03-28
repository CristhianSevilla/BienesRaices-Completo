<?php

namespace Model;

class ActiveRecord{
    //DB
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //errores o validaciones
    protected static $errores = [];

    //guardar en la bd
    public function guardar()
    {
        if (!is_null($this->id)) {
            //actualizar
            $this->actualizar();
        } else {
            //crear un nuevo registro
            $this->crear();
        }
    }

    //insertar un nuevo registro en la bd
    public function crear()
    {
        $datos = $this->sanitizarDatos();

        //join obtiene los valores de un arreglo y devuelve un string plano
        //array_values o array_key permite iterar sobre las llaves o valores de un arreglo asosiativo
        $query = "INSERT INTO "  . static::$tabla . " (";
        $query .= join(', ', array_keys($datos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($datos));
        $query .= "') ";

        //ejecutar query
        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: /admin?mensaje=1');
        }
    }

    public function actualizar()
    {
        $datos = $this->sanitizarDatos();

        $valores = [];
        foreach ($datos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: /admin?mensaje=2');
        }
    }

    //Eliminar un registro
    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id  =  " . self::$db->escape_string($this->id) .  " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?mensaje=3');
        }
    }

    //Lista todas los registos
    public static function all()
    {
        $query = "SELECT * FROM " .static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //obtiene determinado numero de registrso
    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Buscar un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM ". static::$tabla . " WHERE id = ${id}";
        $resultado =  self::consultarSQL($query);
        //array_shift devuelve la primera posición del arreglo
        return array_shift($resultado);
    }

    //sincroniza el objeto en memoeria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)  && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    //Consultar bd
    public static function consultarSQL($query): array
    {
        //consultar la bd
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        //asignar a registroun arreglo asociativo con el resultado de la consulta
        while ($registro = $resultado->fetch_assoc()) {
            //convertir el arreglo en objeto
            $array[] = static::crearObjeto($registro);
        }

        //liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    //Devuelve un objeto con los datos de la base
    protected static function crearObjeto($array): object
    {
        //creamos un nuevo objeto de la tabla
        $objeto = new static;

        foreach ($array as $key => $value) {
            //property_exists compara que el array que resivio tenga una llave igual a la del onjeto
            if (property_exists($objeto, $key)) {
                //si existe las llaves del objeto y el array son iguales asigna valores al objeto
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //sanitizar entrada de datos
    public function sanitizarDatos(): array
    {
        //obtener datos
        $datos = $this->datos();
        $sanitizado = [];

        foreach ($datos as $key => $value) { //recorremos como un arreglo asociativo para conservar la forma
            // sanitizamos datos
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return ($sanitizado);
    }

    //crea un arreglo con la forma de la tabla en la bd con los datos que el usuario ingreso
    public function datos(): array
    {
        $datos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue; //Este dato no se inserta por lo tanto lo ignora
            $datos[$columna] = $this->$columna;
        }
        return $datos;
    }

    //Validacion de formulario (errores)
    public function validarErrores()
    {
        static::$errores = [];
        return static::$errores;
    }

    //subir archivos al servidor
    public function setImagen($imagen)
    {
        //Elimina la imagen previa en caso de que exista
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        //asignar al atributo de la imagen el nombre de la imagen con la que se guarda en la bd
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivos
    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //set DB
    public static function setDB($database)
    {
        self::$db = $database;
    }

    //getErrores
    public static function getErrores(): array
    {
        return static::$errores;
    }
}