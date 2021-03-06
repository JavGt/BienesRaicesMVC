<main class="contenedor seccion">
    <h2 data-cy='heading-nosotros'>Más Sobre nosotros</h2>
    <?php
    include 'iconos.php';
    ?>
</main>

<section class="seccion contenedor">  
    
    <h2>Casas Y Depas en Venta</h2>

    <?php
    $limite = 3;
        include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a data-cy="todas-propiedad" class="boton-verde" href="/propiedades">Ver Todas</a>
    </div>
</section>

<section data-cy="imagen-contacto" class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llene le formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a class="boton-amarillo" href="./contacto">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section data-cy="blog" class="blog">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="./build/img/blog1.webp" type="image/webp">
                    <source srcset="./build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="./build/img/blog1.jpg" alt="Texto entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="./entrada">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta" >Escrito el: <span>20 de Octubre del 2021</span> por: <span>Admin</span> </p>
                    <p>Consejos para construir la Terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.</p>
                </a>
            </div>

        </article><!--.entrada-blog-->

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="./build/img/blog2.webp" type="image/webp">
                    <source srcset="./build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="./entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="informacion-meta" >Escrito el: <span>20 de Octubre del 2021</span> por: <span>Admin</span> </p>
                    <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle una mejor vista a tu espacio.</p>
                </a>
            </div>

        </article><!--.entrada-blog-->

    </section>
    <section data-cy="testimoniales" class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecio cumple con todas las expectativas</blockquote>
            <p>- Javier Gutierrez</p>
        </div>
    </section>

</div>