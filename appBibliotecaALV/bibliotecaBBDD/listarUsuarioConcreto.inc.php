<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función muestra ls datos de un usuario en concreto.
 * @param string $usuario Usuario a buscar.
 * @return array $arrayResultados Retorna un array asociativo con los resultados obtenidos.
 */
function listarUsuarioConcreto(string $usuario):array{
    try {
        $mysqli = establecerConexion();
        if(validarUsuarioText($usuario)) {
            if ($resultado = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE usuario = '$usuario'")) {
                $arrayResultados = mysqli_fetch_all($resultado,MYSQLI_ASSOC);
                /* liberar el conjunto de resultados */
                mysqli_free_result($resultado);
                return $arrayResultados;
            };
        } else {
            return [];
        }
    } catch(Exception $e) {
        return [];
    } finally {
        cerrarConexion($mysqli);
    }
};
?>