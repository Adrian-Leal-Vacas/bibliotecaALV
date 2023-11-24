<?php
// importaciones
include_once "bibliotecaComprobarDatosBBDD/index.inc.php";
include_once "bibliotecaBBDD/index.inc.php";
// Para alquilar un libro
if (isset($_POST["enviar"])) {
    if (isset($_POST["isbn"]) && !empty($_POST["isbn"])) {
        $isbn = $_SESSION["isbn"];
        $arrayResultadosUsuario = listarUsuarioConcreto($_SESSION["usuario"]);
        foreach ($arrayResultadosUsuario as $key => $val) {
            $idUser = $val["id"];
        };
        $arrayResultadosLibro = listarLibrosConcreoto($isbn);
        foreach ($arrayResultadosLibro as $key => $val) {
            $idLibro = $val["id"];
        };
        $correcto = registrarLibrosPrestamos($idUser,$idLibro);
        if (!$correcto) {
        ?>
            <script>
                alert('No se ha podido registrar el libro correctamente, sentimos las molestias.')
            </script>
        <?php
        } else {
            ?>
            <script>
                alert('Libro alquilado correctamete tienes 30 días para leer el libro, gracias por la compra.')
            </script>
        <?php
        }
    };
}
?>
<section>
    <form action="<?php echo $_SERVER["PHP_SELF"] . '?ruta=buscar'; ?>" method="post">
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
<section>
    <table>
        <caption>Libros encontrados</caption>
        <tr>
            <th>ISBN</th>
            <th>TITULO</th>
            <th>AUTOR</th>
            <th>EDITORIAL</th>
            <th>ALQUILAR</th>
        </tr>
        <?php
        // Para el buscador abanzado
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
            // Muestro el libro con los parametros que me han pasado (no necesita el el nombre completo del parametro)
            $arrayResultados = buscarLibros($nombre, $autor, $isbn, $editorial);
            if ($arrayResultados != []) {
                foreach ($arrayResultados as $key => $val) {
                ?>    
                    <tr><td><?php echo $val['isbn']; ?></td>
                        <td><?php echo $val['titulo']; ?></td>
                        <td><?php echo $val['autor']; ?></td>
                        <td><?php echo $val['editorial']; ?></td>
                        <td>    
                            <form action='<?php echo $_SERVER["PHP_SELF"] . "?ruta=buscar"; ?> ' method='post'>
                                <input type='hidden' id='isbn' name='isbn' value=' <?php echo $val["isbn"]; $_SESSION["isbn"] = $val["isbn"]; ?>'>
                                <input type='submit' id='enviar' name='enviar' value='ALQUILAR'>
                            </form>
                        </td>
                    </tr>
                <?php
                };
            } else {
        ?>
                <script>
                    alert('Los sentimos no hemos podido encontrar el libro especificado o esta alquilado, sentimos las molestias.');
                </script>
        <?php
            }
        };
        ?>
    </table>
</section>