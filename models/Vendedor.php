<?php

namespace Model;

class Vendedor extends ActiveRecord{

    protected static $tabla = 'vendedores';
    protected static $columnas_BD = ['id', 'Nombre', 'Apellido', 'Telefono'];

    public $id;
    public $Nombre;
    public $Apellido;
    public $Telefono;

    public function __construct( $args = []) {
        $this->id = $args['id'] ?? NULL;
        $this->Nombre = $args['Nombre'] ?? '' ;
        $this->Apellido = $args['Apellido'] ?? '';
        $this->Telefono = $args['Telefono'] ?? '';      
   }

    public function validar(){

        if (!$this->Nombre) {
            self::$errores[] = 'Debes añadir un Nombre';
        }

        if (!$this->Apellido) {
            self::$errores[] = 'Debes añadir un Apellido';
        }

        if (!$this->Telefono) {
            self::$errores[] = 'Debes añadir un Telefono';
        }
        // Expresion regular
        // Indica que solo permite 10 digitos los cuales son numeros que son del 0 a 9
        if (!preg_match('/[0-9 ]{10}/', $this->Telefono)) {
            self::$errores[] = 'El numero telefonico no es valido';
        }

        return self::$errores;
    }
}
