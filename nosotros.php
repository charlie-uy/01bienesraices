<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.avif" type="image/avif">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem itaque magnam corporis voluptate cum animi porro, corrupti velit dicta. Necessitatibus, cum tenetur dolorem impedit est eum itaque quod animi dolor!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sit ipsa nostrum quae quam quos facilis blanditiis eos, sequi eaque, nobis ducimus quod mollitia, laboriosam corporis delectus minus debitis repudiandae?</p>
            </div>
        </div>



    </main>

    <section class="contenedor seccion">
        <h1>Más sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p></div>
        </div>
    </section>

<?php include 'includes/templates/footer.php'; ?>