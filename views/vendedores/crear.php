<!-- HTML -->
    <main class="contenedor seccion contenido-centrado">
        <h1>Registrar Vendedor</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>
        
        <?php foreach($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>
        
        <form class="formulario" method="POST" action="/vendedores/actualizar" >
            
            <?php 
                include 'formulario.php';
            ?>

            <input type="submit" name="" id="" value="Registrar Vendedor" class="boton boton-verde">
            
        </form>

    </main>