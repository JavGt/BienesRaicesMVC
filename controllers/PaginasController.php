<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);

        $inicio = true;
        $router->render('/paginas/index',[
            'inicio' => $inicio,
            'propiedades' => $propiedades
        ]);
    }

    public static function nosotros(Router $router){

        $router->render('/paginas/nosotros',[]);
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();

        $router->render('/paginas/propiedades',[
            'propiedades' => $propiedades
        ]);

    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('/paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){

        $router->render('/paginas/blog',[]);

    }
    public static function entrada(Router $router){
        $router->render('/paginas/entrada',[]);

    }
    public static function contacto(Router $router){
        $mensaje = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];

            // Crear un instancia con PHPMailer
            $mail = new PHPMailer(true);

            // Configurar SMTP
            $mail->isSMTP();                     //Indicamos que vamos a usar SMTP
            $mail->Host = 'smtp.mailtrap.io';    //Agregar el host
            $mail->SMTPAuth = true;
            $mail->Username = '2bd3444db2354e';
            $mail->Password = 'db8b1204743ae6';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'Bienesraineces.com');
            $mail->Subject ='Tienes un nuevo mensaje';

            // Habilitar HTML 
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contendio
            $contenido = '<html>';
            $contenido.= '<p>Tienes un nuevo mensaje</p>';
            $contenido.= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';

            // Enviar de forma condicional algunos campos 
            if ($respuestas['contacto'] === 'telefono') {
                $contenido.= '<p>Eligió ser contactado por telefono </p>';
                $contenido.= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido.= '<p>Fecha Contacto: ' . $respuestas['fecha'] . '</p>';
            $contenido.= '<p>Hora: ' . $respuestas['hora'] . '</p>';

            } else if ($respuestas['contacto'] === 'email') {
                $contenido.= '<p>Eligió ser contactado por email </p>';
                $contenido.= '<p>Correo: ' . $respuestas['email'] . '</p>';        
            }

            $contenido.= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido.= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido.= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';          
            $contenido.= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';

            // Enviar el mail
            if ($mail->send()) {   
                $mensaje = "mensaje enviado correctamente";
            }else{
                $mensaje = "el mensaje no se puede enviar";
            }

        }
        $router->render('/paginas/contacto',[
            'mensaje' => $mensaje

        ]);

    }
}