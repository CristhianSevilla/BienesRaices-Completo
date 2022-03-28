<?php

require __DIR__ . '/../vendor/autoload.php';
//madamos a llamar Dotenv y una funcion del mismo
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'config/database.php';

//cconexión a DB
$db = conectarDB();

//importar clases
use Model\ActiveRecord;

ActiveRecord::setDB($db);