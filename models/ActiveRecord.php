<?php

namespace Model;

class ActiveRecord{
    
    // Conexión de BD
    protected static $conexion;
    // Columnas de la tabla
    protected static $columnas_BD = [''];
    // Nombre de la tabla
    protected static $tabla = '';
    // Errores
    protected static $errores = [];


    // Definir la conexión de la base de datos a la variable "conexion" de esta clase
    public static function setBD($database){
        // Asigna el contenido 
        self::$conexion = $database;
    }
    
    // Verifica si debe crear un nuevo registro o guardarlo
    public function guardar(){
        // Verifica si "id" esta vacio o NULL
        if (!is_null($this->id)) {
            // Si no esta NULL, actualiza los datos
            $this->actulizar();
        }else{
            // Si esta NULL, Creando un nuevo registro
            $this->crear();
        }
    }

    // Crea un nuevo registro a la BD
    public function crear() {

        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        // Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ( ' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ' ); ";

        // Guardarlos a la base de datos
        $resultado = self::$conexion->query($query);
        // Valida si tiene contenido "resultado"
        if ($resultado) {
            // Redirecciona y manda un dato
            header('Location:/admin?resultado=1');
        }
    }

    // Actualiza un registro de la BD
    public function actulizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
            // Ejemplo : Nombre='Javier'
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        // Ejemplo : UPDATE 'Tabla' SET
        $query.= join(', ', $valores); 
        // Ejemplo : Nombre='Alejandro', Apellido='Luna', Telefono='2462345353'"
        $query.= " WHERE id = '" . self::$conexion->escape_string($this->id) . "'";
        // Ejemplo : WHERE id = '3'
        $query.= " LIMIT 1";

        // Aplica los cambios a la BD y retorna un true o false
        $resultado = self::$conexion->query($query);
        
        // Si el cambio fue exitoso, redirecciona
        if ($resultado) {
            header('Location:/admin?resultado=2');
        }    
        
    }

    // Eliminar un registro
    public function eliminar(){
        // Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$conexion->escape_string($this->id) . " LIMIT 1" ;
        $resultado = self::$conexion->query($query);

        if ($resultado) {
            $this->borraImagen();
            header('Location:/admin?resultado=3');
        }
    }

    public function atributos() : array {
        $atributos = [];

        foreach (static::$columnas_BD as $columna) : 

            // ignora el id para no agregarlo al array
            if ($columna === 'id' ) continue;
            $atributos[$columna] = $this->$columna;

        endforeach;
        return $atributos;
    }

    public function sanitizarDatos() : array {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$conexion->escape_string($value);
        }

        return $sanitizado;
    }

    // Subida de archivos
    public function setImagenes($imagen){
        // Elimina la imagen previa

        if (!is_null( $this->id ) ) {

           $this->borraImagen();
        }

        // Asignar al atributo imagen el nombre de la imagen 
        if ($imagen) {
            $this->Imagen = $imagen;
        }
    }

    // Eliminar archivo
    public function borraImagen(){

        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->Imagen );
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->Imagen);
        }
    }

    // Validacion 
    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];

        return static::$errores;
    }

    // Lista todas los registro
    public static function all(){
        // Escribir el query
        $query = "SELECT * FROM " . static::$tabla;
    
        // Consultar la base de datos
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obteniene determinado numero de registros
    public static function get($cantidad){
        // Escribir el query
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad ;
    
        // Consultar la base de datos
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Buscar un registro por su id
    public static function find( $id ) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);
        // array_shift retorna el primer resultado del arreglo
        return( array_shift($resultado) );
    }

    public static function consultarSQL( $query ) {
        // Consultar la base de datos
        $resultado = self::$conexion->query($query);

        // Iterar los resultados
        $array = [];

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // retornar los resultados
        return ($array);
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value) :
            if(property_exists( $objeto, $key)){
                $objeto->$key = $value;
            }
        endforeach;

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public  function sincronizar( $args = [] ){
        foreach( $args as $key => $value){
            if ( property_exists( $this, $key ) && !is_null($value) ) {
                $this->$key = $value;
            }
        }
    }
}