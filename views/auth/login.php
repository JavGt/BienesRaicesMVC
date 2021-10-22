<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="heading-login" >Inciar Sesión</h1>

    <?php foreach ($errores as $error) :?>
        <div data-cy="alerta-login" class="alerta error" ><?php echo $error;?></div>
    <?php endforeach; ?>

    <form data-cy="formulario-login" method="POST" action="/login" class="formulario">
    <fieldset>        
            <legend>Email y Password</legend>

            <label for="Email">E-mail:</label>
            <input type="email" id="Email" placeholder="Tu Correo" name="Email" >

            <label for="Password">Password:</label>
            <input type="password" id="Password" placeholder="Tu password" name="Password" >

        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>
</main>