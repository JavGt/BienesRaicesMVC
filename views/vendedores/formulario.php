<fieldset>
    <legend>Información General</legend>

    <label for="Nombre">Nombre:</label>
    <input type="text" name="vendedor[Nombre]" id="Nombre" placeholder="Nombre" value="<?php echo sanitizarHTML( $vendedor->Nombre ); ?>" >

    <label for="Apellido">Apellido:</label>
    <input type="text" name="vendedor[Apellido]" id="Apellido" placeholder="Apellido" value="<?php echo sanitizarHTML( $vendedor->Apellido ); ?>" >
</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    <label for="Telefono">Telefono</label>
    <input type="number" name="vendedor[Telefono]" id="Telefono" placeholder="Telefono" value="<?php echo sanitizarHTML( $vendedor->Telefono ); ?>" >
</fieldset>