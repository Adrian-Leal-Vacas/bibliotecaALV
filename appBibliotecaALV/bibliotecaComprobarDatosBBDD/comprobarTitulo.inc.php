<?php
/**
 * Esta función comprueba que el titulo sea valido.
 * @param string $texto Titulo a comprobar. Ejemplo: "pepe"
 * @return boolean Devuelve true si es valido y false si no es valido
 */
function validarTituloText(string $texto):bool {
    $patron = "/[A-Za-z0-9._-]{1,100}$/";
    if (preg_match($patron, $texto) && strlen($texto)<=100) {
        return true;
    } else {
        return false;
    }
}
?>