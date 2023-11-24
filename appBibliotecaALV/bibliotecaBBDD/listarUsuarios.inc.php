<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función muestra todos los datos de todos los usuarios.
 * @return array $arrayResultados Retorna un array asociativo con los resultados obtenidos.
 */
function listarUsuarios():array{
    try {
        $mysqli = establecerConexion();
            if ($resultado = mysqli_query($mysqli, "SELECT * FROM usuarios")) {
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