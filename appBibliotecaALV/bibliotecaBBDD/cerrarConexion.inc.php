<?php
/**
 * Esta función cierra la conexión a la base de datos indicada.
 * @param mysqli $mysqli Conexión a la base de datos.
 */
function cerrarConexion(mysqli $mysqli) {
    mysqli_close($mysqli);
};
?>