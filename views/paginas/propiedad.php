<main class="contenedor seccion contenido-centrado">
        <h1 data-cy="titulo-propiedad"><?php echo $propiedad->Titulo;?></h1>

        <img id="imagen" loading="lazy" src="/imagenes/<?php echo $propiedad->Imagen;?>" alt="Anuncio ">

        <div class="resumen-propiedad">
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
            <p><?php echo $propiedad->Descripcion;?></p>
        
        </div>
    </main>