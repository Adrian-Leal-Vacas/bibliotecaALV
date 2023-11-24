<?php
    // importaciones
    include_once "bibliotecaComprobarDatosBBDD/index.inc.php";
    include_once "bibliotecaBBDD/index.inc.php";
    // Declaro la variable id del usuario
    $id = "";
    // Obtengo los datos del usuario
    $arrayResultados = listarUsuarioConcreto($_SESSION["usuario"]);
    foreach ($arrayResultados as $key => $val) {
        $id = $val["id"];
        $nombre = $val["nombre"];
        $apellido1 = $val["apellido1"];
        $apellido2 = $val["apellido2"];
        $usuario = $val["usuario"];
        $email = $val["email"];
        $contrasena = $val["contraseña"];
    };
    if (isset($_POST["enviar"])) {
        if (isset($_POST["apellido2"]) && !empty($_POST["apellido2"])) {
            if (isset($_POST["passwd"]) && !empty($_POST["passwd"])) {
                actualizarUsuarios($usuario,$_POST["nombre"],$_POST["apellido1"],$_POST["usuario"],$_POST["email"],$_POST["apellido2"],$_POST["passwd"]);
                header("Location: " . $_SERVER["PHP_SELF"] . "?ruta=logout");
            } else {
                actualizarUsuarios($usuario,$_POST["nombre"],$_POST["apellido1"],$_POST["usuario"],$_POST["email"],$_POST["apellido2"]);
                header("Location: " . $_SERVER["PHP_SELF"] . "?ruta=logout");
            }
            
        } else {
            if (isset($_POST["passwd"]) && !empty($_POST["passwd"])) {
                actualizarUsuarios($usuario,$_POST["nombre"],$_POST["apellido1"],$_POST["usuario"],$_POST["email"],null,$_POST["passwd"]);
                header("Location: " . $_SERVER["PHP_SELF"] . "?ruta=logout");
            } else {
                actualizarUsuarios($usuario,$_POST["nombre"],$_POST["apellido1"],$_POST["usuario"],$_POST["email"],null);
                header("Location: " . $_SERVER["PHP_SELF"] . "?ruta=logout");
            }
        }
    };
    if (isset($_POST["eliminar"])) {
        eliminarUsuarios($usuario, $id);
        header("Location: " . $_SERVER["PHP_SELF"] . "?ruta=logout");
    };
    if (isset($_POST["devolver"])) {
        if (isset($_POST["id_libro"]) && !empty($_POST["id_libro"])) {
            $id_libro = $_POST["id_libro"];
            $respuestaDevLibro = eliminarPrestamo($id_libro);
            if ($respuestaDevLibro) {
                ?>
                    <script>
                        alert('El libro se ha devuelto correctamente, espero que te haya gustado el libro.')
                    </script>
                <?php
            } else {
                ?>
                    <script>
                        alert('El libro no se ha podido devolver correctamente, sentimos las molestias.')
                    </script>
                <?php
            }
        };
    };
?>
<section>
    <h1>Bienbenido: <?php echo $_SESSION["usuario"]; ?></h1>
    <div class="datos">
    <h3>Datos:</h3>
        <p>Nombre: <?php echo $nombre; ?></p>
        <p>Apellido 1: <?php echo $apellido1; ?></p>
        <p>Apellido 2: <?php echo $apellido2; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Password: ********</p>
        <p>Usuario: <?php echo $usuario; ?></p>
    </div>
    <br>
    <div class="cambiarDatos">
    <h3>Cambiar datos: </h3>
    <form action="<?php echo $_SERVER["PHP_SELF"] . "?ruta=perfil"; ?>" method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
        <label for="apellido1">Apellido 1: </label>
        <input type="text" id="apellido1" name="apellido1" value="<?php echo $apellido1; ?>"><br>
        <label for="apellido2">Apellido 2: </label>
        <input type="text" id="apellido2" name="apellido2" value="<?php echo $apellido2; ?>"><br>
        <label for="email">Email: </label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
        <label for="passwd">Password: </label>
        <input type="text" id="passwd" name="passwd"><br>
        <label for="usuario">Usuario: </label>
        <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>"><br><br>
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=logout"; ?>"> Cerrar sesión</a>
        <input type="submit" id="eliminar" name="eliminar" value="Eliminar cuenta">
        <input type="submit" id="enviar" name="enviar" value="Actualizar">
    </form>
    </div>
</section>
<div class="librosPrestamoUser">
    <table>
        <caption>Libros alquilados</caption>
        <tr>
            <th>ISBN</th>
            <th>TITULO</th>
            <th>AUTOR</th>
            <th>EDITORIAL</th>
            <th>FIN PRESTAMO</th>
            <th>DEVOLVER</th>
        </tr>
        <?php
        // Muestro los libros que tiene en prestamo el usuario.
        $arrayResultados = listarLibrosPrestamosUser($id);
        foreach ($arrayResultados as $key => $val) {
            ?>
                <tr><td><?php echo $val['isbn']; ?></td>
                    <td><?php echo $val['titulo']; ?></td>
                    <td><?php echo $val['autor']; ?></td>
                    <td><?php echo $val['editorial']; ?></td>
                    <td><?php echo $val['finPrestamo']; ?></td>
                    <td>    
                        <form action='<?php echo $_SERVER["PHP_SELF"] . "?ruta=perfil"; ?>' method='post'>
                            <input type='hidden' id='id_libro' name='id_libro' value='<?php echo $val["id"] ?>'>
                            <input type='submit' id='devolver' name='devolver' value='DEVOLVER'>
                        </form>
                    </td>
                </tr>
        <?php
        };
        ?>
    </table>
    </div>