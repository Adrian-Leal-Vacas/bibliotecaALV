<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función muestra un libro en especifico disponibles de forma páginada.
 * @param int $isbn ISBN del libro. Ejemplo: "999-555-77-1-8".
 * @return array $arrayResultados Retorna un array asociativo con los resultados obtenidos.
 */
function listarLibrosConcreoto(string $isbn):array{
    try {
        $mysqli = establecerConexion();
        if ($resultado = mysqli_query($mysqli, "SELECT * FROM libros WHERE isbn = '$isbn'")) {
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