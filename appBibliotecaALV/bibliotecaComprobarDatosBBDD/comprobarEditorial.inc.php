<?php
/**
 * Esta función comprueba que la editorial sea valido.
 * @param string $texto Editorial a comprobar. Ejemplo: "pepe"
 * @return boolean Devuelve true si es valido y false si no es valido
 */
function validarEditorialText(string $texto):bool {
    $patron = "/[A-Za-z0-9._-]{1,60}$/";
    if (preg_match($patron, $texto) && strlen($texto)<=60) {
        return true;
    } else {
        return false;
    }
}
?>