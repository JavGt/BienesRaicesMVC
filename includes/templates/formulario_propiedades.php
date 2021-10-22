<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" name="propiedad[Titulo]" id="titulo" placeholder="Titulo propiedad" value="<?php echo sanitizarHTML( $propiedad->Titulo ); ?>" >

    <label for="precio">Precio:</label>
    <input type="number" name="propiedad[Precio]" id="precio" placeholder="Precio Propiedad" value="<?php echo sanitizarHTML( $propiedad->Precio ); ?>" >

    <label for="imagen">Imagen</label>
    <input type="file" name="propiedad[Imagen]" id="imagen" accept="image/jpeg, image/png">
    <?php if ($propiedad->Imagen) : ?>
        <img src="/imagenes/<?php echo $propiedad->Imagen;?>" class="img-small contenedor" >
    <?php endif; ?>        

    <label for="descripcion">Descripcion:</label>
    <textarea name="propiedad[Descripcion]" id="descripcion" ><?php echo sanitizarHTML($propiedad->Descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" name="propiedad[Habitaciones]" id="habitaciones"min="1" max="9" placeholder="Ejemplo: 3" value="<?php echo sanitizarHTML($propiedad->Habitaciones); ?>" >

    <label for="wc">Baños:</label>
    <input type="number" name="propiedad[WC]" id="wc" min="1" max="9" placeholder="Ejemplo: 2" value="<?php echo sanitizarHTML($propiedad->WC); ?>" >

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" name="propiedad[Estacionamiento]" id="estacionamiento"min="1" max="9" placeholder="Ejemplo: 1" value="<?php echo sanitizarHTML($propiedad->Estacionamiento); ?>" >
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="idVendedor">Vendedor</label>
    <select name="propiedad[idVendedor]" id="idVendedor">
        <option value="" selected disabled>--Seleccionar--</option>
        <?php foreach ($vendedores as $vendedor) :?>
            <option 

            <?php echo $propiedad->idVendedor == $vendedor->id ? 'selected' : ''; ?>

            value="<?php echo sanitizarHTML($vendedor->id); ?> "><?php echo sanitizarHTML($vendedor->Nombre) ." ". sanitizarHTML($vendedor->Apellido); ?></option>
        <?php endforeach;  ?>

    </select>
 
</fieldset>