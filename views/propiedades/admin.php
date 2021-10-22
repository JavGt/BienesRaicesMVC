<main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php
        if ($resultado) {
            $mensaje = mostrarNotifiacion( intval($resultado) );
            
            if ($mensaje) : ?>
            <p class="alerta exito" ><?php echo sanitizarHTML($mensaje); ?></p>
            <?php endif; 
        }
        ?>        

        <a href="/propiedades/crear" class="boton boton-verde"> <i class="bi bi-plus-lg"></i> Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo"> <i class="bi bi-plus-lg"></i> Nuevo Vendedor</a>

        <h2>Propiedades</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="tbody"> <!--Mostrar los resultados-->
            <?php  foreach( $propiedades as $propiedad ):?>
                    <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->Titulo; ?></td>
                    <td><img src="/imagenes/<?php echo$propiedad->Imagen;?>" alt="" class="imagen-tabla contenedor" ></td>
                    <td><span class="precio-tabla" >$ <?php echo $propiedad->Precio; ?></span> </td>
                    <td>

                        <form method="POST" class="w-100 boton-form" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar"></input>
                        </form>

                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
                
            </tbody>
        </table>
        
        <h2>Vendedores</h2>
        <table class="propiedades">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Numero Telefonico</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody class="tbody" > 
            <!--Mostrar los resultados-->
            <?php  foreach( $vendedores as $vendedor ):?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->Nombre ." " .$vendedor->Apellido; ?></td>
                    <td>+52 <?php echo $vendedor->Telefono; ?></td>
                    <td>
                        <form action="/vendedores/eliminar" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar" ></input>
                        </form>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
</main>