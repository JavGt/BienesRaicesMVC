<?php

namespace Model;

class Admin extends ActiveRecord{
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnas_BD = [
        'id',
        'Email',
        'Password'
    ];

    public $id;
    public $Email;
    public $Password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->Email = $args['Email'] ?? '';
        $this->Password = $args['Password'] ?? '';
    }

    public function validar()
    {
        if (!$this->Email) {
            self::$errores[] = 'El Email es obligatorio';
        }
        if (!$this->Password) {
            self::$errores[] = 'El Password es obligatorio';
        }
        return self::$errores;
    }
    public function existeUsuario(){
        // Revisar si un usuario exite o ono
        $query = "SELECT * FROM " . self::$tabla . " WHERE Email='" . $this->Email . "' LIMIT 1";
        $resultado = self::$conexion->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
            return;
        }

        return $resultado;
    }
    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();

        $autenticado =  password_verify($this->Password, $usuario->Password);

        if (!$autenticado) {
            self::$errores[] = 'Contraseña incorrecta';
        }
        return $autenticado; 
    }

    public function autenticar(){
        session_start();

        // Llenar el arreglo
        $_SESSION['asuario'] = $this->Email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}