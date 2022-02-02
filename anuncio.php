<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.avif" type="image/avif">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$ 3.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="Baños" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Estacionamientos" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="Habitaciones" loading="lazy">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum voluptate labore officiis temporibus veniam fuga, vel, esse et accusantium sit iste quibusdam eaque non architecto quasi necessitatibus. Molestias, modi rem.</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum sunt reprehenderit doloremque voluptate delectus amet, a inventore odit, placeat consequuntur dolor minima corporis rerum! Vero sapiente id consequatur animi officiis!</p>
        </div>

    </main>

<?php include 'includes/templates/footer.php'; ?>