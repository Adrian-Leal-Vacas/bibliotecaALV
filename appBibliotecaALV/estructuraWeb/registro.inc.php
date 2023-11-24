<?php
// importaciones
include_once "bibliotecaComprobarDatosBBDD/index.inc.php";
include_once "bibliotecaBBDD/index.inc.php";
// Inicializa la variable de control para mostrar el formulario
$mostrarFormulario = true;
$mal = false;
if (isset($_POST["reg"])) {
    // Comprobamos el usuario
    // Si el usuario se ha enviado y que no este vacio
    if (isset($_POST["usuario"]) && !empty($_POST["usuario"])) {
        // Creo una variable con el nombre del usuario
        $usuario = $_POST["usuario"];
    } else {
        // Creo una variable para indicar en el formulario que el usuaio es obligatorio
        $errUsuario = true;
    }
    // Comprobamos contraseña
    // Si la contraseña se ha enviado y no esta vacia
    if (isset($_POST["passwd"]) && !empty($_POST["passwd"])) {
        // Creo una variable con la contraseña
        $passwd = $_POST["passwd"];
    } else {
        // Creo una variable para indicar en el formulario que la contraseña es obligatoria
        $errPasswd = true;
    }
    // Si el npmbre se ha enviado y que no este vacio
    if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
        // Creo una variable con el nombre del nombre
        $nombre = $_POST["nombre"];
    } else {
        // Creo una variable para indicar en el formulario que el npmbre es obligatorio
        $errNombre = true;
    }
    // Comprobamos apellido1
    // Si el apellido1 se ha enviado y no esta vacia
    if (isset($_POST["apellido1"]) && !empty($_POST["apellido1"])) {
        // Creo una variable con el apellido
        $apellido1 = $_POST["apellido1"];
    } else {
        // Creo una variable para indicar en el formulario que el apellido es obligatoria
        $errApellido1 = true;
    }
    // compruebo si el email se ha enviado y no esta vacio
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        // Creo una variable con el email
        $email = $_POST["email"];
    } else {
        // Creo una variable para indicar en el formulario que el email es obligatoria
        $errEmail = true;
    }
    // Comprueba si se debe mostrar el formulario o el botón "Pulsa para iniciar"
    if ((isset($errNombre) && $errNombre) ||
        (isset($errApellido1) && $errApellido1) ||
        (isset($errEmail) && $errEmail) ||
        (isset($errUsuario) && $errUsuario) ||
        (isset($errPasswd) && $errPasswd)
    ) {
        // Mostrar formulario y mensaje de error
        $mostrarFormulario = true;
    } else {
        // No mostrar el formulario, solo el botón "Pulsa para iniciar"
        $mostrarFormulario = false;
    }
}
?>
<!-- Sección con un formulario -->
<section>
    <!-- START FORM -->
    <?php if ($mostrarFormulario) { // Verifica si debe mostrar el formulario 
    ?>
        <form action="<?php echo $_SERVER["PHP_SELF"] . "?ruta=registro"; ?>" method="post">
            <h2 class="login-title">Registro</h2>
            <?php
            if (isset($errNombre) && $errNombre) {
            ?>
                <p class="error-message">Nombre es obligatorio</p>
            <?php }; ?>
            <label for="nombre">Escribe tu nombre <span class="obligatorio">*</span>: </label>
            <input type="text" id="nombre" name="nombre" value="<?php if (isset($nombre)) echo $nombre ?>"><br>
            <?php
            if (isset($errApellido1) && $errApellido1) {
            ?>
                <p class="error-message">1º apellido es obligatorio</p>
            <?php }; ?>
            <label for="apellido1">Escribe tu 1º apellido <span class="obligatorio">*</span>: </label>
            <input type="text" id="apellido1" name="apellido1" value="<?php if (isset($apellido1)) echo $apellido1 ?>"><br>
            <label for="apellido2">Escribe tu 2º apellido: </label>
            <input type="text" id="apellido2" name="apellido2"><br>
            <?php
            if (isset($errEmail) && $errEmail) {
            ?>
                <p class="error-message">Email es obligatorio</p>
            <?php }; ?>
            <label for="email">Escribe tu email <span class="obligatorio">*</span>: </label>
            <input type="email" id="email" name="email" value="<?php if (isset($email)) echo $email ?>"><br>
            <?php
            if (isset($errUsuario) && $errUsuario) {
            ?>
                <p class="error-message">Usuario es obligatorio</p>
            <?php }; ?>
            <label for="usuario">Escribe tu usuario <span class="obligatorio">*</span>: </label>
            <input type="text" id="usuario" name="usuario" value="<?php if (isset($usuario)) echo $usuario ?>"><br>
            <?php
            if (isset($errPasswd) && $errPasswd) {
            ?>
                <p class="error-message">Contraseña es obligatorio</p>
            <?php }; ?>
            <label for="passwd">Escribe tu password <span class="obligatorio">*</span>: </label>
            <input type="password" id="passwd" name="passwd"><br>
            <a href="index.php" class="boton-extras">Iniciar sesión</a>
            <?php
            if ((isset($errNombre) && $errNombre) || (isset($errApellido1) && $errApellido1) || (isset($errEmail) && $errEmail) || (isset($errUsuario) && $errUsuario) || (isset($errPasswd) && $errPasswd)) {
            ?>
                <script>
                    alert('Los campos indicados son obligaotrios')
                </script>
            <?php } ?>
            <input type="submit" id="reg" name="reg" value="Registrarte">
        </form>
    <?php } else { // Muestra solo el botón "Pulsa para iniciar" (importar registrar usuario y que no sea false lo que devuelve)  
        if (isset($_POST["apellido2"]) && !empty($_POST["apellido2"])) {
            if (!validarNombreText($nombre) || !validarApellidoText($apellido1) || !validarUsuarioText($usuario) || !validarEmailText($email) || !validarApellidoText($_POST["apellido2"]) ) {
                $mal = true;         
            } else {
                $regis = registrarUsuario($nombre,$apellido1,$usuario,$passwd,$email,$_POST["apellido2"]);
                if ($regis) {
                    ?>
                        <script>
                            alert('Registrado correctamente a continuación pulse a "Pulsa para iniciar"');
                        </script>
                    <?php
                }                
            }
        } else {
            if (!validarNombreText($nombre) || !validarApellidoText($apellido1) || !validarUsuarioText($usuario) || !validarEmailText($email)) {
                $mal = true;
            } else {
                $regis = registrarUsuario($nombre,$apellido1,$usuario,$passwd,$email);
                if ($regis) {
                ?>
                    <script>
                        alert('Registrado correctamente a continuación pulse a "Pulsa para iniciar"');
                    </script>
                <?php
                }    
            }
        }   
    ?>
        <a href=<?php if ($mal) { echo $_SERVER["PHP_SELF"] . "?ruta=registro";} else if (!$regis) {echo $_SERVER["PHP_SELF"];} else {echo $_SERVER["PHP_SELF"];} ?> class="boton-extras"><?php if ($mal) {echo "Los campos son demasiados grandes o invalidos";} else if (!$regis) {echo "El usuario introducido ya existe";} else {echo "Pulsa para iniciar";}?></a>
    <?php } ?>
    <!-- END FORM -->
</section>