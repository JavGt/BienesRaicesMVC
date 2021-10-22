<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    
    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" href="/build/img/favicon.png" type="image/x-icon">

    <!-- Css -->
    <link rel="stylesheet" href="/build/css/app.css">
    <!-- iconos de boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <title>Bienes Raices</title>
</head>
<body>
    <header class="header <?php  echo $inicio ? 'inicio': '' ?>">
        <div class="contenedor contenido-header ">
            <div class="barra">
                <a href="/index.php">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    <nav class="navegacion" >
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if ($auth) :?>
                        <a href="/admin">Administrador</a>
                        <a href="/cerrar-sesion.php">Cerrar Sesion</a>
                        <?php elseif(!$auth):?>
                        <a href="/login.php"> Iniciar Sesion</a>
                        <?php endif;?>
                    </nav>
                </div>

            </div><!--.barra-->

            <?php echo $inicio ? "<h1>Venta de Casa y Departamentos Exclusivos de Lujo</h1>" : '';?>
        </div>
    </header>