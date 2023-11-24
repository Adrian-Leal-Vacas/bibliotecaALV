<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función cambia la contraseña al usuario por la contraseña por defecto que es "1234".
 * @param int $id Id dek usuario. Ejemplo: 1
 * @param string $passwd Contraseña por defecto (lo paso por parametro por cambio de password de forma más sencilla en caso de cambiar la password por defecto).
 * @return bool Retorna un boolean segun este correcto o no.
 */
function cambiarPasswd(int $id,string $passwd):bool {
    try {
        $mysqli = establecerConexion();
            $contrasenaHaseada = password_hash($passwd,PASSWORD_BCRYPT);
            if (mysqli_query($mysqli, "UPDATE usuarios SET contraseña = '$contrasenaHaseada' WHERE id = $id ")) {
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