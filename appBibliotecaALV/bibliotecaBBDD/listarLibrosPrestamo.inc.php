<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función muestra lso libros que estan alquilados su información y la fecha de devolución.
 * @return array $arrayResultados Retorna un array asociativo con los resultados obtenidos.
 */
function listarLibrosPrestamos():array{
    try {
        $mysqli = establecerConexion();
        if ($resultado = mysqli_query($mysqli, "SELECT libros.*, prestamos.finPrestamo FROM libros INNER JOIN prestamos ON libros.id = prestamos.id_libros WHERE libros.enPrestamo IS NOT NULL ORDER BY prestamos.finPrestamo;")) {
            $arrayResultados = mysqli_fetch_all($resultado,MYSQLI_ASSOC);
            /* liberar el conjunto de resultados */
            mysqli_free_result($resultado);
            return $arrayResultados;
        };
    } catch(Exception $e) {
        return [];
    } finally {
        cerrarConexion($mysqli);
    }
};
?>