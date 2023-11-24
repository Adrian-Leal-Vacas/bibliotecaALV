<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
* Esta función inserta un registro en la base de datos especificada en la tabla prestamos.
* @param string $id_usuario Id del usuario. Ejemplo: 2.
* @param string $id_libro Id del libro. Ejemplo: 21.
* @return boolean Devuelve true si se ha insertado correctamente y false si no se ha insertado correctamente.
*/
function registrarLibrosPrestamos(int $id_usuario,int $id_libro):bool {
    try {
        $mysqli = establecerConexion();
        $fechaActual = date('Y-m-d'); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        // Convierte la fecha actual a un objeto DateTime
        $fecha = new DateTime($fechaActual);
        // Suma 30 días a la fecha
        $fecha->add(new DateInterval('P30D'));
        // Obtiene la fecha resultante después de agregar 30 días
        $fechaMas30Dias = $fecha->format('Y-m-d');
        //Ingresar libro
        if (mysqli_query($mysqli, "INSERT INTO prestamos
                                    VALUES('".$id_usuario."','".$id_libro."','".$fechaMas30Dias."');") === TRUE) {
            mysqli_query($mysqli, "UPDATE libros
                                    SET enPrestamo = 1
                                    WHERE id = '$id_libro'");
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