<?php

namespace Model;

class Propiedad extends ActiveRecord {
    protected static $columnas_BD = ['id', 'Titulo', 'Precio', 'Imagen', 'Descripcion', 'Habitaciones', 'WC', 'Estacionamiento','Creado', 'idVendedor'];

    protected static $tabla = 'propiedades';

    public $id;
    public $Titulo;
    public $Precio;
    public $Imagen;
    public $Descripcion;
    public $Habitaciones;
    public $WC;
    public $Estacionamiento;
    public $Creado;
    public $idVendedor;

    public function __construct( $args = []) {
        $this->id = $args['id'] ?? NULL;
        $this->Titulo = $args['Titulo'] ?? '' ;
        $this->Precio = $args['Precio'] ?? '';
        $this->Imagen = $args['Imagen'] ?? '';
        $this->Descripcion = $args['Descripcion'] ?? '';
        $this->Habitaciones = $args['Habitaciones'] ?? '';
        $this->WC = $args['WC'] ?? '';
        $this->Estacionamiento = $args['Estacionamiento'] ?? '';
        $this->Creado = date('Y-m-d');
        $this->idVendedor = $args['idVendedor'] ?? '' ;         
   }

    public function validar(){
        // var_dump($imagen['name']);

        if (!$this->Titulo) {
            self::$errores[] = 'Debes añadir un titulo';
        }if (!$this->Precio) {
            self::$errores[] = 'Debes añadir un precio';
        }if (strlen($this->Descripcion) < 50) {
            self::$errores[] = 'Debe tener al menos 50 caracteres';
        }if (!$this->Habitaciones) {
            self::$errores[] = 'Debes añadir una habitaciones';
        }if (!$this->WC) {
            self::$errores[] = 'Debes añadir un Baño';
        }if (!$this->Estacionamiento) {
            self::$errores[] = 'Debes añadir un estacionamiento';
        }if (!$this->idVendedor) {
            self::$errores[] = 'Debes añadir un vendedor';
        }
        if (!$this->Imagen) {
            self::$errores[] = 'Debes añadir una imagen';
        }

        return self::$errores;
    }
}