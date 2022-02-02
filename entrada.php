<?php 

    require 'includes/funciones.php';
    incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.avif" type="image/avif">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum voluptate labore officiis temporibus veniam fuga, vel, esse et accusantium sit iste quibusdam eaque non architecto quasi necessitatibus. Molestias, modi rem.</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum sunt reprehenderit doloremque voluptate delectus amet, a inventore odit, placeat consequuntur dolor minima corporis rerum! Vero sapiente id consequatur animi officiis!</p>
        </div>

    </main>

<?php incluirTemplate('footer'); ?>