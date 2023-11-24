<?php
// Importaciones
include_once "bibliotecaComprobarDatosBBDD/index.inc.php";
include_once "bibliotecaBBDD/index.inc.php";
// Para alquilar un libro
if (isset($_POST["enviar"])) {
    if (isset($_POST["isbn"]) && !empty($_POST["isbn"])) {
        $isbn = $_POST["isbn"];
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
<section class="fondoTabla">
    <table>
        <caption>Libros disponibles</caption>
        <tr>
            <th>ISBN</th>
            <th>TITULO</th>
            <th>AUTOR</th>
            <th>EDITORIAL</th>
            <th>ALQUILAR</th>
        </tr>
        <?php
        // Páginación
        if (!isset($_GET["pag"]) || ($_GET["pag"] == 1)) {
            $limite = 0;
        } else {
            $limite = 6 * ($_GET["pag"] - 1);
        }
        // Muestro la información d elos libros de froma paginada
        $arrayResultados = listarLibros($limite);
        foreach ($arrayResultados as $key => $val) {
        ?>
            <tr><td><?php echo $val['isbn']; ?></td>
                <td><?php echo $val['titulo']; ?></td>
                <td><?php echo $val['autor']; ?></td>
                <td><?php echo $val['editorial']; ?></td>
                <td>    
                    <form action='<?php echo $_SERVER["PHP_SELF"] . "?ruta=principal"; ?>' method='post'>
                        <input type='hidden' id='isbn' name='isbn' value='<?php echo $val["isbn"] ?>'>
                        <input type='submit' id='enviar' name='enviar' value='ALQUILAR'>
                    </form>
                </td>
            </tr>
        <?php
        };
        ?>
        <?php $numResultados = numeroFilas(); ?>
        <tr>
            <td colspan="5">
                <?php if (!isset($_GET["pag"]) || ($_GET["pag"] == 1)) {
                } else {
                ?>
                    <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=principal&pag=" . ($_GET["pag"] - 1); ?>">Anterior</a>
                <?php 
                }?> 
                <?php 
                    if (!isset($_GET["pag"])) {
                ?>
                        <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=principal&pag=2"; ?>">Siguiente</a>
                <?php
                    } else {
                        if (($_GET["pag"] + 1) < (($numResultados / 6) + 1)) {
                ?>
                    <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=principal&pag=" . ($_GET["pag"] + 1); ?>">Siguiente</a>
                <?php
                        }
                    }
                ?>
            </td>
        </tr>
    </table>
</section>