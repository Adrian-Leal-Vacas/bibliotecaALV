<?php
/**
 * Esta función comprueba que el nombre sea entre 1 y 30 caracteres y que empieze por un caracter alfanumerico.
 * @param string $texto Nombre a comprobar. Ejemplo: "pepe"
 * @return boolean Devuelve true si es valido y false si no es valido
 */
function validarNombreText(string $texto):bool {
    $patron = "/^[a-zA-Z0-9]{1,30}$/";
    if (preg_match($patron, $texto) && strlen($texto)<=30) {
        return true;
    } else {
        return false;
    }
};
?>