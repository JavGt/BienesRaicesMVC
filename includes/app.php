<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base de datos
$conexion = conectarDB();

// NameSpaces
use Model\ActiveRecord;

ActiveRecord::setBD($conexion);