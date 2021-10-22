<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function crear(Router $router){
        // Variables
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        // Funciones
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);
    
            // Validar los campos no esten vacios
            $errores = $vendedor->validar();
    
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        // View
        $router->render('/vendedores/crear',[
            'vendedor' => $vendedor,
            'errores' => $errores

        ]);
    }
    
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $errores = Vendedor::getErrores();
        $vendedor = Vendedor::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['vendedor'];
    
            // Sincronizar el objeto en memoria con lo que el usuario escribiio
            $vendedor->sincronizar($args);
    
            $errores = $vendedor->validar();
            
            if (empty($errores)) {
                $vendedor->guardar();
            }     
        }

        $router->render('/vendedores/actualizar',[
            'vendedor' => $vendedor,
            'errores' => $errores

        ]);
    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {    

            // Guarda el contenido que POST['id'] a "id"
            // -----------------------------------------
            $id = $_POST['id'];

            // Convierte el contenido de "$id" aun entero
            // -----------------------------------------
            $id = filter_var($id, FILTER_VALIDATE_INT);

            // Valida si "id" tiene contenido
            // -----------------------------------------
            if ($id) {
                // Guarda en la variable "tipo" contenido de $_POST['tipo'] (vendedor o propiedad)
                // -----------------------------------------
                $tipo = $_POST['tipo'];
                
                // Si el contenido de "tipo" esta en los roles asignados, regresa un true o false
                // -----------------------------------------
                if (validarTipoCotenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    // Borra todos los registros
                    // -----------------------------------------
                    $vendedor->eliminar();
                }
            }
        }
    }
    
}