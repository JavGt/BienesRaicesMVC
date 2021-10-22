<?php

namespace MVC;

class Router{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        // Llena el arreglo con las url que se envia
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn){
        // Llena el arreglo con las url que se envia
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {
        session_start();
        $auth = $_SESSION['login'] ?? NULL;
        // Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin','/propiedades/crear','/propiedades/actualizar','/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar','/propiedades/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; 
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }

        // Proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($fn) {
            // Permite llamar una función cuando no sabemos como se llama
            call_user_func($fn, $this);
        }else{
            echo "pagina no encontrada 404";
        }
    }

    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            $$key = $value;
            // $$ - crear una variable con el mismo nombre de la "key" y le asigna el contenido
        }

        // Inicia un almacenamiento en memoria
        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //Limpia el Buffer
        include __DIR__ . "/views/layout.php";
    }
}