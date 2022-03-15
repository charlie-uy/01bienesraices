<?php
session_start();

    $auth = $_SESSION['login'] ?? false;

    if(!$auth) {
        header('Location: /');
    }

    //Importar la conexióm
    require "../includes/config/database.php";
    $db = conectarDB();
    // Escribir la query
    $query = "SELECT * FROM propiedades";

    // Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;


    // ¡ Código video eliminar propiedades
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            // Eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink('../imagenes/' . $propiedad['imagen']);

            // Elimina la propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                header('location: /admin?resultado=3');
            }
        }
    }
    

    // Incluye un template
    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if( $resultado == 1): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif( $resultado == 2): ?>
            <p class="alerta exito">Anuncio actualizado correctamente</p>
        <?php elseif( $resultado == 3): ?>
            <p class="alerta exito">Anuncio eliminado correctamente</p>
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

        <table class="propiedades"> <!-- Mostrar los resultados -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td> <?php echo $propiedad['id']; ?> </td>
                    <td> <?php echo $propiedad['titulo']; ?> </td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad['precio']; ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>


<?php

    // Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer');
?>