<nav>
    <h2 class="titleNav">Biblioteca ALV</h2>
    <?php
    // Para todos los usuarios se muestra los siguientes enlaces
    if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
    ?>
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=principal"; ?>">Inicio</a>
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=buscar"; ?>">Buscador</a>
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=perfil"; ?>">Perfil</a>
    <?php
    };
    ?>
    <?php
    // Para el administrador
    if (isset($_SESSION["rol"]) && !empty($_SESSION["rol"]) && $_SESSION["rol"] == "administrador") {
    ?>
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=administracion"; ?>">Administración</a>
    <?php
    };
    ?>
    <?php
    // Para todos los usuarios se muestra los siguientes enlaces
    if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
    ?>
        <a href="<?php echo $_SERVER["PHP_SELF"] . "?ruta=logout"; ?>">Cerrar sesión</a>
    <?php
    };
    ?>
</nav>