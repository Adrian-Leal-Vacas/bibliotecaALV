<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función elimina un usuario de la base de datos asignada.
 * @param string $usuario Nombre del usuario Ejemplo: "pepe".
 * @param int $id_usuario del usuario. Ejemplo: 2.
 * @return bool devuelve true si ha eliminado el usuario y false si no lo ha podido eliminar.
 */
function eliminarUsuarios(string $usuario,int $id_usuario) {
    try{
        $mysqli = establecerConexion();
        $resultadoPrestamos = mysqli_query($mysqli, "SELECT id_libros FROM prestamos WHERE id_usuario = $id_usuario");
        
        if ($resultadoPrestamos) {
            // Obtener los id_libros como un array
            $idLibros = mysqli_fetch_all($resultadoPrestamos, MYSQLI_ASSOC);
        
            // Liberar el conjunto de resultados
            mysqli_free_result($resultadoPrestamos);
        
            // Actualizar los libros enPrestamo a null y elimino en la tabla prestamos
            foreach ($idLibros as $libro) {
                $idLibro = $libro['id_libros'];
                mysqli_query($mysqli, "UPDATE libros SET enPrestamo = NULL WHERE id = '$idLibro'");
                mysqli_query($mysqli, "DELETE FROM prestamos WHERE id_libros = '$idLibro'");
            }
        }
        if(validarUsuarioText($usuario)) {
            if (mysqli_query($mysqli, "DELETE FROM usuarios WHERE usuario = '$usuario';")) {
                return true;
            } else {
                return false;
            }
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