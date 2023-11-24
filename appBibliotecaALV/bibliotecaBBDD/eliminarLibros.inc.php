<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función elimina un libro de la base de datos asignada.
 * @param int $id_libro Identificador del libro Ejemplo: 9.
 * @return bool devuelve true si ha eliminado el libro y false si no lo ha podido eliminar.
 */
function eliminarLibros(int $id_libro):bool {
    try {
        $mysqli = establecerConexion();
        if (mysqli_query($mysqli, "DELETE FROM libros WHERE id = $id_libro AND enPrestamo IS NULL;")) {
            return true;    
        } else {
            return false;
        }
    } catch(Exception $e) {
        return false;
    } finally {
        cerrarConexion($mysqli);
    }
};
?>