<?php
/**
 * Esta función comprueba que el isbn sea valido.
 * @param string $texto ISBN a comprobar. Ejemplo: "777-77-5-777"
 * @return boolean Devuelve true si es valido y false si no es valido
 */
function validarISBNText(string $texto):bool {
    $patron = "/[A-Za-z0-9._-]{1,30}$/";
    if (preg_match($patron, $texto) && strlen($texto)<=30) {
        return true;
    } else {
        return false;
    }
}
?>