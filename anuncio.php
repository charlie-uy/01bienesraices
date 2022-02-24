<?php 

    // ! Validar la URL y que se pase un id válido

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    // ¡ Si el id no es válido se redirecciona al admin
    if (!$id) {
        header('Location: /');
    }

    // Base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    // ¡ Obtener los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);

    if(!$resultado->num_rows) {
        header('Location: /');
    }
    $propiedad = mysqli_fetch_assoc($resultado);

    // ¡ Cabecera de la página
    require 'includes/funciones.php';
    incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imágen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio">$ <?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="Baños" loading="lazy">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Estacionamientos" loading="lazy">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="Habitaciones" loading="lazy">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>

    </main>

<?php
    // ¡ Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer'); ?>