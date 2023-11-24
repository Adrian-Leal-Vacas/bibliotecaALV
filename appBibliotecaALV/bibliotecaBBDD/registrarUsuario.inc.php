<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función inserta un usuario en la base de datos especificada.
 * @param string $nombre Nombre del usuario. Ejemplo: "pepe".
 * @param string $apellido1 Primer apellido del usuario. Ejemplo: "garcia".
 * @param string $usuario Usuario con el que te vas a registrar. Ejemplo: "pepe".
 * @param string $contrasena Contraseña del usuario. Ejemplo: "1234".
 * @param string $email Email del usuario. Ejemplo: "pepe@gmail.com".
 * @param string $apellido2 default => null Segundo apellido del usuario. Ejemplo: "martinez".
 * @param string $rol default => "lector" Rol con el que se va a identificar en la página o aplicación. Ejemplo: "lector".
 * @return boolean Devuelve true si se ha creado el usuario correctamente y false si no se ha creado correctamente.
 */
function registrarUsuario(string $nombre,string $apellido1,string $usuario,string $contrasena,string $email,string $apellido2=null,string $rol="lector"):bool {
    try {
        $mysqli = establecerConexion();
        $contrasenaHaseada = password_hash($contrasena,PASSWORD_BCRYPT);
        if (validarNombreText($nombre) && validarUsuarioText($usuario) && validarApellidoText($apellido1)) {
            if ($apellido2 != null) {
                if(validarApellidoText($apellido2)) {
                    if (mysqli_query($mysqli, "INSERT INTO usuarios (`nombre`,`apellido1`,`apellido2`,`usuario`,`contraseña`,`email`,`rol`) 
                                    VALUES('".$nombre."','".$apellido1."','".$apellido2."','".$usuario."','".$contrasenaHaseada."','".$email."','".$rol."');") === TRUE) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                if (mysqli_query($mysqli, "INSERT INTO usuarios (`nombre`,`apellido1`,`apellido2`,`usuario`,`contraseña`,`email`,`rol`) 
                                    VALUES('".$nombre."','".$apellido1."','".$apellido2."','".$usuario."','".$contrasenaHaseada."','".$email."','".$rol."');") === TRUE) {
                        return true;
                    } else {
                        return false;
                    }
            }
        } else {
            return false;
        }
    } catch(Exception) {
        return false;
    } finally {
        cerrarConexion($mysqli);
    }
}
?>