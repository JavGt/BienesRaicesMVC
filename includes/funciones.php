<?php
define('TEMPLATES_URL', __DIR__ . './templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplates(string $nombre, bool  $inicio = false){
    include TEMPLATES_URL . "/${nombre}.php";
}

function verificarSesion() {
    session_start();

    if (!$_SESSION['login']) {
        header("Location: /");
    }
}

function debuguear($nombre){
    echo "<pre>";
    var_dump($nombre);
    echo "</pre>";
    exit;
}

// Escapa / Sanitiza el HTML
function sanitizarHTML( $html ) : string {
    $sanitizado = htmlspecialchars( $html );
    return $sanitizado;
}

// Validar tipo de contenido
function validarTipoCotenido($tipo){
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

// Envia el mensaje para cierta acción
function mostrarNotifiacion($codigo){
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Borrado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url){
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${url} ");
    }
    return $id;
}