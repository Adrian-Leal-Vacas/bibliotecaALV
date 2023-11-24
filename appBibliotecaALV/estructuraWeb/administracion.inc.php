<?php
// importaciones
include_once "bibliotecaComprobarDatosBBDD/index.inc.php";
include_once "bibliotecaBBDD/index.inc.php";
// Para eliminar un libro en concreto
if (isset($_POST["enviar"])) {
    if (isset($_POST["isbn"]) && !empty($_POST["isbn"])) {
        $isbn = $_POST["isbn"];
        $arrayResultadosLibro = listarLibrosConcreoto($isbn);
        foreach ($arrayResultadosLibro as $key => $val) {
            $idLibro = $val["id"];
        };
        $correcto = eliminarLibros($idLibro);
        if (!$correcto) {
?>
            <script>
                alert('No se ha podido borrar el libro, sentimos las molestias.')
            </script>
        <?php
        } else {
        ?>
            <script>
                alert('Libro borrado correctamete .')
            </script>
<?php
        }
    };
};
// Para crear un libro
if (isset($_POST["addLibros"])) {
    if (isset($_POST["ISBN"]) && !empty($_POST["ISBN"])) {
        $addISBN = $_POST["ISBN"];
    };
    if (isset($_POST["tituloLibro"]) && !empty($_POST["tituloLibro"])) {
        $tituloLibro = $_POST["tituloLibro"];
    };
    if (isset($_POST["autorLibro"]) && !empty($_POST["autorLibro"])) {
        $autorLibro = $_POST["autorLibro"];
    };
    if (isset($_POST["editorialLibro"]) && !empty($_POST["editorialLibro"])) {
        $editorialLibro = $_POST["editorialLibro"];
    };
    if (isset($addISBN) && isset($tituloLibro) && isset($autorLibro) && isset($editorialLibro)) { 
        $libroCorrecto = registrarLibros($addISBN,$tituloLibro,$autorLibro,$editorialLibro);
        if ($libroCorrecto) {
            ?>
                <script>
                    alert('El libro se a añadido correctamente')
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert('El libro no se ha podido añadir porque los datos introducidos no son validos.')
                </script>
            <?php
        }
    } else {
        ?>
            <script>
                alert('Todos los datos son obligatorios.')
            </script>
        <?php
    }
};
?>
<section>
    <form action="<?php echo $_SERVER["PHP_SELF"] . '?ruta=administracion'; ?>" method="post">
        <h2 class="login-title">Buscador de libros</h2>
        <label for="nombre">Escribe el nombre del libro: </label>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="autor">Escribe el nombre del autor: </label>
        <input type="text" id="autor" name="autor"><br>
        <label for="isbn">Escribe el isbn del libro: </label>
        <input type="text" id="isbn" name="isbn"><br>
        <label for="editorial">Escribe el nombre de la editorial: </label>
        <input type="text" id="editorial" name="editorial"><br>
        <input type="submit" id="buscar" name="buscar" value="Buscar">
    </form>
</section>
<section class="ampliado">
    <table>
        <caption>Libros encontrados</caption>
        <tr>
            <th>ISBN</th>
            <th>TITULO</th>
            <th>AUTOR</th>
            <th>EDITORIAL</th>
            <th>EN PRESTAMO</th>
            <th>ELIMINAR</th>
        </tr>
        <?php
        // Buscador avanzado de libros
        if (isset($_POST["buscar"])) {
            $nombre = null;
            $autor = null;
            $isbn = null;
            $editorial = null;
            if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
                $nombre = $_POST["nombre"];
            }
            if (isset($_POST["autor"]) && !empty($_POST["autor"])) {
                $autor = $_POST["autor"];
            }
            if (isset($_POST["isbn"]) && !empty($_POST["isbn"])) {
                $isbn = $_POST["isbn"];
            }
            if (isset($_POST["editorial"]) && !empty($_POST["editorial"])) {
                $editorial = $_POST["editorial"];
            }
            $arrayResultados = buscarLibrosAdmin($nombre, $autor, $isbn, $editorial);
            if ($arrayResultados != []) {
                foreach ($arrayResultados as $key => $val) {
                ?>
                    <tr><td><?php echo $val['isbn']; ?></td>
                        <td><?php echo $val['titulo']; ?></td>
                        <td><?php echo $val['autor']; ?></td>
                        <td><?php echo $val['editorial']; ?></td>
                        <td><?php echo $val['enPrestamo']; ?></td>
                        <td>    
                            <form action='<?php echo $_SERVER["PHP_SELF"] . "?ruta=administracion"; ?>' method='post'>
                                <input type='hidden' id='isbn' name='isbn' value='<?php echo $val["isbn"]; ?>'>
                                <input type='submit' id='enviar' name='enviar' value='ELIMINAR'>
                            </form>
                        </td>  
                    </tr>
                <?php
                };
            } else {
        ?>
                <script>
                    alert('Los sentimos no hemos podido encontrar el libro especificado, sentimos las molestias.');
                </script>
        <?php
            }
        };
        ?>
    </table>
</section>
<section>
    <form action="<?php echo $_SERVER["PHP_SELF"] . '?ruta=administracion'; ?>" method="post">
        <h2 class="login-title">Buscador de usuarios</h2>
        <label for="user">USUARIOS</label>
        <select name="user" id="user">
            <?php
            $arrayIdUsur = listarUsuarios();
            foreach ($arrayIdUsur as $key => $val) {
                echo "<tr>
                        <td>" . "<option value='" . $val['usuario'] . "'>" . $val['usuario'] . "</option>" . "</td>
                  </tr>";
            };
            ?>
        </select>
        <input type="submit" id="usuarios" name="usuarios" value="Mostrar información">
    </form>
    <br>
    <?php
    // Buscador de usuario, mostar su información, cambiar contraseña y eliminar el usuario
    if (isset($_POST["usuarios"])) {
        if (isset($_POST["user"]) && !empty($_POST["user"])) {
            $_SESSION["usuarioEliminar"] = $_POST["user"];
            $arrayResultados = listarUsuarioConcreto($_POST["user"]);
            foreach ($arrayResultados as $key => $val) {
                $_SESSION["usuarioID"] = $val["id"];
                $nombre = $val["nombre"];
                $apellido1 = $val["apellido1"];
                $apellido2 = $val["apellido2"];
                $usuario = $val["usuario"];
                $email = $val["email"];
            }
        };
    ?>
        <div class="datos">
            <h3>Datos:</h3>
            <p>Nombre: <?php echo $nombre; ?></p>
            <p>Apellido 1: <?php echo $apellido1; ?></p>
            <p>Apellido 2: <?php echo $apellido2; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Password: ********</p>
            <p>Usuario: <?php echo $usuario; ?></p>
            <form action="<?php echo $_SERVER["PHP_SELF"] . '?ruta=administracion'; ?>" method="post">
                <input type="submit" id="eliminarUser" name="eliminarUser" value="Eliminar usuario">
            </form>
            <form action="<?php echo $_SERVER["PHP_SELF"] . '?ruta=administracion'; ?>" method="post">
                <input type="submit" id="newPasswd" name="newPasswd" value="Cambiar contraseña">
            </form>
        </div>
        <?php
    };
    if (isset($_POST["eliminarUser"])) {
        $bienEliminado = eliminarUsuarios($_SESSION["usuarioEliminar"], $_SESSION["usuarioID"]);
        if ($bienEliminado) {
            header("Location: " . $_SERVER["PHP_SELF"] . "?ruta=administracion");
        } else {
        ?>
            <script>
                alert('El usuario no se ha podido eliminar correctamente, sentimos las molestias.')
            </script>
        <?php
        }
    };
    if (isset($_POST["newPasswd"])) {
        $cambioContrasenaOk = cambiarPasswd($_SESSION["usuarioID"], "1234");
        if ($cambioContrasenaOk) {
        ?>
            <script>
                alert('La contraseña se ha cambiado correctamente a la contraseña por defecto que es "1234"')
            </script>
        <?php
        } else {
        ?>
            <script>
                alert('La contraseña no se ha podido cambiar, sentimos las molestias')
            </script>
    <?php
        }
    };
    ?>
</section>
<section>
    <form action="<?php echo $_SERVER["PHP_SELF"] . '?ruta=administracion'; ?>" method="post">
        <h2 class="login-title">Añadir libros</h2>
        <label for="ISBN">ISBN <span class="obligatorio">*</span></label>
        <input type="text" id="ISBN" name="ISBN"><br>
        <label for="tituloLibro">Titulo del libro <span class="obligatorio">*</span></label>
        <input type="text" id="tituloLibro" name="tituloLibro"><br>
        <label for="autorLibro">Autor <span class="obligatorio">*</span></label>
        <input type="text" id="autorLibro" name="autorLibro"><br>
        <label for="editorialLibro">Editorial <span class="obligatorio">*</span></label>
        <input type="text" id="editorialLibro" name="editorialLibro"><br>
        <input type="submit" id="addLibros" name="addLibros" value="Añadir libros">
    </form>
</section>