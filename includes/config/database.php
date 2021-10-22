<?php
function conectarDB() : mysqli {
    $conexion = new mysqli('sql304.epizy.com','epiz_30059878','KXpFCcOyQjFzLk','epiz_30059878_bienes_raices');
    // $conexion = new mysqli('localhost','root','','bienes_raices');

    if (!$conexion) {
       echo "Fallo en la conexión";
       exit;
    }
    
    return $conexion;
}
