<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función muestra los libros disponibles de forma páginada.
 * @param int $limite Desde donde quieres empezar a que te muestre.
 * @return array $arrayResultados Retorna un array asociativo con los resultados obtenidos.
 */
function listarLibros(int $limite):array{
    try {
        $mysqli = establecerConexion();
        if ($resultado = mysqli_query($mysqli, "SELECT * FROM libros WHERE enPrestamo IS NULL LIMIT $limite,6")) {
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