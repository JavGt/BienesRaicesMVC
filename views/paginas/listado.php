<div class="contenedor-anuncios" >
    <?php foreach( $propiedades as $propiedad ) : ?>
             
    <div class="anuncio" data-cy="anuncio">
            
        <img  loading="lazy" src="/imagenes/<?php echo $propiedad->Imagen;?>" alt="Anuncio ">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->Titulo; ?></h3>
            <p class="descipcion" ><?php echo $propiedad->Descripcion;?></p>
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

            <a data-cy="enlace-propiedad" class="boton-amarillo-block" href="/propiedad?id=<?php echo $propiedad->id;?>">Ver Propiedad</a>

        </div><!--.contenido-anuncio-->
    </div><!--.anuncio-->

    <?php endforeach; ?>

</div><!--.contenedor-anuncios-->