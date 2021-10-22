document.addEventListener('DOMContentLoaded', function(){

    eventListeners();

    darkmode();
    mostrarImagen();
});

function mostrarImagen(){
    const imagen = document.querySelector('#imagen');
    if (imagen) {
        imagen.onclick = function(){
            const body = document.querySelector('body');
            const overlay = document.createElement('DIV');
            const imagenG = document.createElement('IMG');
            imagenG.src = imagen.src; 
            overlay.classList.add('overlay');
            overlay.appendChild(imagenG);
            body.appendChild(overlay);

            //Boton para cerrar la imagen
            overlay.onclick = function(){
                overlay.remove();
                body.classList.remove('fijar-body');
            }
        }
    }
}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
    
    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

}
function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');
    if(e.target.value === 'email'){
        contactoDiv.innerHTML = `
        <label for="email">E-mail:</label>
        <input type="email" id="email" placeholder="Tu Correo" name="contacto[email]" >
        `;
    }else if(e.target.value === 'telefono'){
        contactoDiv.innerHTML = `
        <label for="telefono">Número de Teléfono:</label>
        <input data-cy="telefono-numero" type="tel" id="telefono" placeholder="Tu Teléfono" name="contacto[telefono]">

        <p>Elijala fecha y hora para la llamada</p>

        <label for="fecha">Fecha:</label>
        <input data-cy="telefono-fecha" type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input data-cy="telefono-hora" type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;

    }
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar'); //la condicion hace lo mismo que el togle

    // if(navegacion.classList.contains('mostrar')){
    //     navegacion.classList.remove('mostrar');
    // }else{
    //     navegacion.classList.add('mostrar');
    // }
}

function darkmode(){

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme:dark)');
    
    console.log(prefiereDarkMode.matches);
    if(prefiereDarkMode.matches){
        document.body.classList.toggle('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function(){
        document.body.classList.toggle('dark-mode');
    });


    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });
}