<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
* Esta función inserta un libro en la base de datos especificada.
* @param string $isbm ISBN del libro. Ejemplo: "978-84-08-26792-8".
* @param string $titulo Titulo del libro. Ejemplo: "El arte de ser nosotros".
* @param string $autor Autor del libro. Ejemplo: "Inma Rubiales".
* @param string $editorial Contraseña del usuario. Ejemplo: "Editorial Planeta".
* @return boolean Devuelve true si se ha insertado el libro correctamente y false si no se ha insertado correctamente.
*/
function registrarLibros(string $isbn,string $titulo,string $autor,string $editorial):bool  {
    try {
        $mysqli = establecerConexion();
        if (validarISBNText($isbn) && validarTituloText($titulo) && validarAutorText($autor) && validarEditorialText($editorial)) {
            if (mysqli_query($mysqli, "INSERT INTO libros (`isbn`,`titulo`,`autor`,`editorial`) 
                                    VALUES('".$isbn."','".$titulo."','".$autor."','".$editorial."');") === TRUE) {
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