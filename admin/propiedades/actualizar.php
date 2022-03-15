<?php
    
    //¡ Validar login
    
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    // ! Validar la URL y que se pase un id válido
    
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    // ¡ Si el id no es válido se redirecciona al admin
    if (!$id) {
        header('Location: /admin');
    }

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // ¡ Obtener los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    // ¡ Consultar para obtener los vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // ! Arreglo con mensajes de errores

    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

    // ¡ Ejecutar el código después que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor'] );
        $creado = date('Y/m/d');

        // Asignar archivos hacia una variable
        $imagen = $_FILES['imagen'];

        /*  echo "<pre>";
        var_dump($imagen);
        echo "</pre>"; */

        if(!$titulo) {
            $errores[] = "Debes añadir un título";
        }
        if(!$precio) {
            $errores[] = "El precio es obligatorio";
        }
        if (strlen($descripcion) < 50) {
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$habitaciones) {
            $errores[] = "El número de habitaciones es obligatorio";
        }
        if(!$wc) {
            $errores[] = "El número de baños es obligatorio";
        }
        if(!$estacionamiento) {
            $errores[] = "El número de lugares de estacionamientos es obligatorio";
        }
        if(!$vendedorId) {
            $errores[] = "Es necesario especificar el vendedor";
        }

        //Validar por tabaño 100 Kb máximo
        $medida = 1000 * 100;

        if( !$imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy grande. Máximo 100kB';
        }


        //* Revisa que el arreglo de errores esté vacío
        if(empty($errores)) {

            //* Subida de archivos

            // Carpeta
            $carpetaImagenes = '../../imagenes/';

            // ¡ Caso de nueva foto
            if($imagen['name']) {
                // Eliminar la imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                // ¡ Define la extensión para el archivo
                // A mejorar posteriormente
                if ($imagen['type'] === 'image/jpeg') {
                    $exten = '.jpg';
                } else {
                    $exten = '.png';
                }

                //* Generar un nombre único para la imagen
                $nombreImagen = md5( uniqid( rand() , true))  . $exten;

                //* Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            // ¡ Caso mantiene foto
            } else {
                $nombreImagen = $propiedad['imagen'];
            }

            // ! Actualizar en la base de datos
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = ${precio}, imagen = '${nombreImagen}',  descripcion = '${descripcion}',  habitaciones = ${habitaciones},  wc = ${wc},  estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id}";

            // ¡ Código para prueba
            //echo $query;
            //exit;

            $resultado = mysqli_query($db, $query);
            
            if($resultado) {
                // Se redirecciona al usuario
                header('Location: /admin?resultado=2');
            }

        }
        
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar propiedad</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio de venta:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png, image/jpg">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Cantidad de habitaciones" min="1" max="9"  value="<?php echo $habitaciones; ?>" >

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Cantidad de baños" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Cantidad de estacionamientos" min="1" max="9"  value="<?php echo $estacionamiento; ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">-- Seleccione -- </option>
                    <?php while($row = mysqli_fetch_assoc($resultado)) : ?>
                        <option 
                            <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?>
                            value="<?php echo $row['id']?>">
                            <?php echo $row['nombre']. ' ' . $row['apellido']; ?>
                        </option>    
                    <?php endwhile; ?>
                </select>

            </fieldset>
            
            <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
        </form>

        <a href="/admin" class="boton boton-verde">Volver</a>
    </main>


<?php
    incluirTemplate('footer');
?>