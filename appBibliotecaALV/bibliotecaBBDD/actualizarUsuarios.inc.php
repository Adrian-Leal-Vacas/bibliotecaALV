<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función actuali8za los datos de un usuario de la base de datos asignado.
 * @param string $usuario_old Usuario antiguo Ejemplo: "pepe".
 * @param string $nombre Nombre del usuario Ejemplo: "pepe".
 * @param string $apellido1 Primer apellido Ejemplo: "fernandez".
 * @param string $usuario_new Usuario nuevo Ejemplo: "pepe".
 * @param string $email Email del usuario Ejemplo: "pepe@gmail.com".
 * @param string $apellido2=null Segundo apellido Ejemplo: "perez".
 * @param string $contrasena=null Contraseña Ejemplo: "pepe".
 */
function actualizarUsuarios(string $usuario_old, string $nombre, string $apellido1, string $usuario_new, string $email, $apellido2=null,$contrasena=null) {
    try{
        $mysqli = establecerConexion();
        if(validarUsuarioText($usuario_old) && validarUsuarioText($usuario_new) && validarApellidoText($apellido1) &&validarEmailText($email)) {
            if ($contrasena!=null) {
                $contrasenaHaseada = password_hash($contrasena,PASSWORD_BCRYPT);
                if ($apellido2!=null) {
                    if (validarApellidoText($apellido2)) {
                        mysqli_query($mysqli, "UPDATE usuarios SET nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', usuario='$usuario_new', email='$email', contraseña='$contrasenaHaseada' WHERE usuario = '$usuario_old';");        
                    } else {
                    ?>
                        <script>
                            alert('Apellido2 es inavalido porfavor compruebe los datos')
                        </script>
                    <?php
                    }
                } else {
                    mysqli_query($mysqli, "UPDATE usuarios SET nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', usuario='$usuario_new', email='$email', contraseña='$contrasenaHaseada' WHERE usuario = '$usuario_old';");
                }
                
            } else {
                if ($apellido2!=null) {
                    if (validarApellidoText($apellido2)) {
                        mysqli_query($mysqli, "UPDATE usuarios SET nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', usuario='$usuario_new', email='$email' WHERE usuario = '$usuario_old';");
                    } else {
                    ?>
                        <script>
                            alert('Apellido2 es inavalido porfavor compruebe los datos')
                        </script>
                    <?php
                    }
                    
                } else {
                    mysqli_query($mysqli, "UPDATE usuarios SET nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', usuario='$usuario_new', email='$email' WHERE usuario = '$usuario_old';");
                }
            }
        } else {
            ?>
                <script>
                    alert('Los datos introducidos son invalidos por favor escribe sin comillas simple y lo más breve posible')
                </script>
            <?php
        }
    } catch(Exception $e) {
        ?>
            <script>
                alert('Lo sentimos ha habido un ERROR al actualizar el usuario ')
            </script>
        <?php
    } finally {
        cerrarConexion($mysqli);
    }
}
?>