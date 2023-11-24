<?php
/**
 * Esta función comprueba que el email sea valido.
 * @param string $texto Email a comprobar. Ejemplo: "pepe"
 * @return boolean Devuelve true si es valido y false si no es valido
 */
function validarEmailText(string $texto):bool {
    $patron = "/^[A-Za-z][A-Za-z0-9._-]*@[A-Za-z0-9.-]+\.[A-Za-z0-9.-]{1,60}$/";
    
    if (preg_match($patron, $texto) && strlen($texto)<=60) {
        return true;
    } else {
        return false;
    }
}
?>