<?php
// importaciones
include_once "bibliotecaComprobarDatosBBDD/index.inc.php";
include_once "bibliotecaBBDD/index.inc.php";
//Iniciamos las sesiones es obligatorio
session_start();
//Si recibimos datos del formulario (el formulario esta en login.inc.php)
if (isset($_POST["enviar"])) {
    // Comprobamos el usuario
    if (isset($_POST["usuario"]) && !empty($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
    } else {
        $errUsuario = true;
    }
    // Comprobamos contraseña
    if (isset($_POST["passwd"]) && !empty($_POST["passwd"])) {
        $passwd = $_POST["passwd"];
    } else {
        $errPasswd = true;
    }
    // Comprobar si el usuario y la contraseña es valido
    try {
        if (!isset($errUsuario) && !isset($errPasswd) && (comprobarUsuarioLogin($usuario, $passwd) === 1)) {
            $arrUsuario = listarUsuarioConcreto($usuario);
            foreach ($arrUsuario as $key => $val) {
                $_SESSION["rol"] = $val['rol'];
                $_SESSION["usuario"] = $val['usuario'];
            };
            header("Location: " . $_SERVER["PHP_SELF"] . "?ruta=principal");
            exit;
        } else {
            $errValidacion = true;
        }
    } catch (Exception $e) {
        echo "Error: " . $e;
    }
};
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Página de DAW2</title>
</head>
<body>
    <!-- Importo la cabezera -->
    <?php include_once "./estructuraWeb/cabezera.inc.php" ?>
    <!-- Importo el menu -->
    <?php include_once "./estructuraWeb/menu.inc.php" ?>
    <!-- Importo el cuerpo de mi página -->
    <?php
    // Si la ruta get que indicamos arriba es vacia le enviamos al formulario
    if (empty($_GET) || !isset($_SESSION["usuario"])) {
        if (isset($_GET["ruta"]) && ($_GET["ruta"] == "registro")) {
            include_once "./estructuraWeb/registro.inc.php";
        } else {
            if (!isset($_SESSION["usuario"]) && isset($_GET["ruta"]) && ($_GET["ruta"] == "principal" || $_GET["ruta"] == "perfil" || $_GET["ruta"] == "logout" || $_GET["ruta"] == "buscar" || $_GET["ruta"] == "administracion")) {
    ?>
                <script>
                    alert('Es obligatorio el inicio de sesión para entrar a la página perdone las molestias');
                </script>
    <?php
                include_once "./estructuraWeb/login.inc.php";
            } else {
                include_once "./estructuraWeb/login.inc.php";
            }
        }
    } elseif (isset($_SESSION["usuario"])) {
        if (isset($_GET["ruta"]) && ($_GET["ruta"] == "principal")) {
            include_once "./estructuraWeb/cuerpo.inc.php";
        } elseif (isset($_GET["ruta"]) && ($_GET["ruta"] == "perfil")) {
            include_once "./estructuraWeb/perfil.inc.php";
        } elseif (isset($_GET["ruta"]) && ($_GET["ruta"] == "logout")) {
            include_once "./estructuraWeb/logout.inc.php";
        } elseif (isset($_GET["ruta"]) && ($_GET["ruta"] == "buscar")) {
            include_once "./estructuraWeb/buscar.inc.php";
        } elseif (isset($_GET["ruta"]) && ($_GET["ruta"] == "administracion") && $_SESSION["rol"] == "administrador") {
            include_once "./estructuraWeb/administracion.inc.php";
        } elseif (isset($_GET["ruta"]) && ($_GET["ruta"] == "administracion") && $_SESSION["rol"] !== "administrador") {
            ?>
            <script>
                alert('Esta opción esta bloqueda solo pueden haceder los administradores');
            </script>
        <?php
        header("refresh:0.2;url= " . $_SERVER["PHP_SELF"]."?ruta=principal");
        }
    }
    ?>
    <!-- Importo el pie de página -->
    <?php include_once "./estructuraWeb/pie.inc.php" ?>
</body>
</html>