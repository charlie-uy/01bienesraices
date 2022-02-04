<?php

    // Base de datos
    require '../../includes/config/database.php';
    
    $db = conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <form class="formulario">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" placeholder="Título propiedad">

                <label for="imagen">Imagen:</label>
                <input type="number" id="precio" placeholder="Precio propiedad">
                
                <label for="Imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Cantidad de habitaciones" min="1" max="9">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" placeholder="Cantidad de baños" min="1" max="9">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" placeholder="Cantidad de estacionamientos" min="1" max="9">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select>
                    <option value="1">Juan</option>
                    <option value="2">Karen</option>
                </select>

            </fieldset>
            
            <input type="submit" value="Crear propiedad" class="boton boton-verde">
        </form>

        <a href="/admin" class="boton boton-verde">Volver</a>
    </main>


<?php
    incluirTemplate('footer');
?>