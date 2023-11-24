<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función dice cuanto libros hay disponible.
 * @return int $res Retorna el numeor de libros que hay.
 */
function numeroFilas():int {
    try{
        $mysqli = establecerConexion();
        $res = 0;
            $query = "SELECT * FROM libros WHERE enPrestamo IS NULL;";
            if ($resultado = mysqli_query($mysqli,$query)) {
                $res= mysqli_num_rows($resultado);
            /* liberar el conjunto de resultados */
                mysqli_free_result($resultado);
            };
            return $res;
    } catch(Exception $e) {
        return 0;
    } finally {
        cerrarConexion($mysqli);
    }
}
?>