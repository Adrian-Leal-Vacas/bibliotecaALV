<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función lista los libros de un usuario determinado.
 * @param int $id_user Id del usuario.
 * @return array $arrayResultados Retorna un array asociativo con los resultados obtenidos.
 */
function listarLibrosPrestamosUser(int $id_user):array{
    try {
        $mysqli = establecerConexion();
        if ($resultado = mysqli_query($mysqli, "SELECT libros.*, prestamos.finPrestamo
        FROM libros
        INNER JOIN prestamos ON libros.id = prestamos.id_libros
        WHERE libros.enPrestamo IS NOT NULL AND prestamos.id_usuario = $id_user
        ORDER BY prestamos.finPrestamo;")) {
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