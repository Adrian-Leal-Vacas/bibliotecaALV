<?php
/**
 * Esta función comprueba que el Password sea entre 1 y 200 caracteres y que empieze por un patron de encriptación en concreto $2y$10$.
 * @param string $texto Contraseña a comprobar. Ejemplo: "$2y$10$hdfh4df65hfd65hffh46h54df4hdhfgh4df65"
 * @return boolean Devuelve true si es valido y false si no es valido
 */
function validarPasswordText(string $texto):bool {
    (string) $patron = "/^[\$2y\$10\$].{1,200}$/";
    if (preg_match($patron, $texto) && strlen($texto)<=200) {
        return true;
    } else {
        return false;
    }
}
?>