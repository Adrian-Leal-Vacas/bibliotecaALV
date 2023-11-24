<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función comprueba si un usuario existe en la base de datos utilizando el nombre del usuario y su contraseña.
 * @param string $usuario Usuario que quieres comprobar. Ejmeplo: "pepe"
 * @param string $contrasena Contraseña que tiene el usuario introducido anteriormente. Ejemplo: "1234"
 * @return int $res Retorna 1 si existe y 0 si no existe el usario.
 */
function comprobarUsuarioLogin(string $usuario,string $contrasena):int {
    try{
        $mysqli = establecerConexion();
        $res = 0;
        $okPassword = "";
        $contrasenaHaseada = "";
        $okUsuario = validarUsuarioText($usuario);
        if ($okUsuario) {
            $arrRespuesta = listarUsuarioConcreto($usuario);
            foreach ($arrRespuesta as $key => $val) {
                $contrasenaHaseada = $val['contraseña'];
            };
        } else {
            return $res;
        }
        if (password_verify($contrasena,$contrasenaHaseada)){
            $okPassword = validarPasswordText($contrasenaHaseada);
        }  else {
            return $res;
        }
        if ($okUsuario && $okPassword) {
            $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contrasenaHaseada';";
            if ($resultado = mysqli_query($mysqli,$query)) {
                $res= mysqli_num_rows($resultado);
            /* liberar el conjunto de resultados */
                mysqli_free_result($resultado);
            };
            return $res;
        } else {
            return $res;
        }
    } catch(Exception $e) {
        return 0;
    } finally {
        cerrarConexion($mysqli);
    }
}
?>