<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Imagen;

class PropiedadController{

    public static  function index(Router $router){
        // Variables
        // -------------------------
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null; 

        // View
        // -------------------------
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static  function crear(Router $router){
        // Variables
        // -------------------------
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        // Funciones
        // -------------------------
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            // ------Subida de archivos------

            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            // Setear la imagen
            if ($_FILES['propiedad']['tmp_name']['Imagen']) {
                // Realiza un resize a la imagen con intervation
                $image = Imagen::make($_FILES['propiedad']['tmp_name']['Imagen'])->fit(800, 600);
                $propiedad->setImagenes($nombreImagen); 
            }
            // Validar
            $errores = $propiedad->validar();

            // Revisas si ya no tiene errores
            if (empty($errores)) {

                // Crear una carpeta 
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datos
                $propiedad->guardar();            
            }
        }

        // View
        // -------------------------
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static  function actualizar(Router $router){
        // Variables
        // -------------------------
        $id = validarORedireccionar('/admin');
        $errores = Propiedad::getErrores();
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        // Funciones
        // -------------------------
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['propiedad'] ;
          
            $propiedad->sincronizar($args);
    
            // Validacion 
            $errores = $propiedad->validar();

            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
    
            // Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['Imagen']) {
                // Realiza un resize a la imagen con intervation
                $image = Imagen::make($_FILES['propiedad']['tmp_name']['Imagen'])->fit(800, 600);
                $propiedad->setImagenes($nombreImagen); 
            }            
    
            // Revisas si ya no tiene errores
            if (empty($errores)) {
                // Almacenar la imagen en el disco
                if ($_FILES['propiedad']['tmp_name']['Imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                // Insertar en la base de datos
                $propiedad->guardar();
            }
        }

        // View
        // -------------------------
        $router->render('/propiedades/actualizar',[
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(Router $router){
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
                    $propiedad = Propiedad::find($id);
                    // Borra todos los registros
                    // -----------------------------------------
                    $propiedad->eliminar();
                }
            }
        }

    }

}
