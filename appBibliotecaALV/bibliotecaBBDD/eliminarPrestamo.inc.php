<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función elimina un prestamo de la base de datos asignada.
 * @param int $id_libro Id del libro. Ejemplo: 2.
 * @return bool devuelve true si ha eliminado el libro y false si no lo ha podido eliminar.
 */
function eliminarPrestamo(int $id_libro):bool {
    try{
        $mysqli = establecerConexion();
        // Actualizar los libros enPrestamo a null y elimino en la tabla prestamos
        if (mysqli_query($mysqli, "UPDATE libros SET enPrestamo = NULL WHERE id = '$id_libro'") && mysqli_query($mysqli, "DELETE FROM prestamos WHERE id_libros = '$id_libro'")) {
            return true;
        } else {
            return false;
        }         
    } catch(Exception $e) {
        return false;
    } finally {
        cerrarConexion($mysqli);
    }
}
?>