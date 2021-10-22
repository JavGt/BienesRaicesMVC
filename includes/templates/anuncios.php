<?php 
    use App\Propiedad;

    if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php' ) {
        $propiedades = Propiedad::all();
    }elseif ($_SERVER['SCRIPT_NAME'] === '/index.php' ){
        $propiedades = Propiedad::get(3);
    }
    
?>
<div class="contenedor-anuncios">
    <?php foreach( $propiedades as $propiedad ) : ?>
             
    <div class="anuncio">
            
        <img  loading="lazy" src="/imagenes/<?php echo $propiedad->Imagen;?>" alt="Anuncio ">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->Titulo; ?></h3>
            <p><?php echo $propiedad->Descripcion;?></p>
            <p class="precio">$<?php echo $propiedad->Precio;?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->WC;?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad->Estacionamiento;?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad->Habitaciones;?></p>
                </li>
            </ul>

            <a class="boton-amarillo-block" href="anuncio.php?id=<?php echo $propiedad->id;?>">Ver Propiedad</a>

        </div><!--.contenido-anuncio-->
    </div><!--.anuncio-->

    <?php endforeach; ?>

</div><!--.contenedor-anuncios-->