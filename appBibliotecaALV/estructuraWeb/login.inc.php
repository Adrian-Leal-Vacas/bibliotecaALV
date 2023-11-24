<!-- Sección con el formulario de login -->
<section class="login">
    <!-- Le muestro fuera del formulario un error que el usuairo y contraseña introducidos son incorrectos -->
    <?php
    if (isset($errValidacion) && $errValidacion && !isset($errUsuario) && !isset($errPasswd)) {
    ?>
        <p class="error-message">Usuario y/o contrasña incorrecta</p>
    <?php }; ?>
    <!-- START FORM -->
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <h2 class="login-title">Inicio de sesión</h2>
        <!-- Mostrar mensaje de error diciendo usuario no valido (obligatorio) -->
        <?php
        if (isset($errUsuario) && $errUsuario) {
        ?>
            <p class="error-message">Usuario no valido</p>
        <?php }; ?>
        <!-- Pido el usuario -->
        <label for="usuario">Escribe tu usuario <span class="obligatorio">*</span>: </label>
        <!-- Guardo en value el nombre del usuario si no esta en blanco -->
        <input type="text" id="usuario" name="usuario" value="<?php if (isset($usuario)) echo $usuario ?>"><br>
        <!-- Mostrar mensaje de error diciendo contraseña no valida (obligatorio) -->
        <?php
        if (isset($errPasswd) && $errPasswd) {
        ?>
            <p class="error-message">Contraseña no valido</p>
        <?php }; ?>
        <!-- Pido la contraseña -->
        <label for="passwd">Escribe tu password <span class="obligatorio">*</span>: </label>
        <input type="password" id="passwd" name="passwd"><br>
        <!-- Botón registro -->
        <a href="index.php?ruta=registro" class="boton-extras">Ir a Registro</a>
        <!-- Botón de enviar -->
        <input type="submit" id="enviar" name="enviar" value="Enviar">
    </form>
    <!-- END FORM -->
</section>