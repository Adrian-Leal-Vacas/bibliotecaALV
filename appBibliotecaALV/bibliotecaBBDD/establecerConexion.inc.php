<?php
/**
 * Esta función estable la conexion a la base de datos indicada.
 * @param string $host Donde esta la base de datos. Ejemplo: "localhost".
 * @param string $usuarioBD El usuario de la base de datos. Ejemplo: "biblioteca".
 * @param string $passwordBD La contraseña para la base de datos del usuario indicado anteriormente. Ejemplo: "1234".
 * @param string $nombreBD Como se llama la base de datos a la que vamos a hacer conexión. Ejemplo: "biblioteca".
 * @return mysqli $mysqli Regresa la conexión a la base de datos
 */
function establecerConexion(/*string $host,string $usuarioBD,string $passwordBD, string $nombreBD*/):mysqli {
    $mysqli = mysqli_connect("localhost","biblioteca","1234","biblioteca");
    //Si la conexión falla, muestro error
    if (mysqli_connect_errno()) {
        ?>
            <script>
                alert('No hemos podido establecer conexión con la base de datos sentimos las molestias.')
            </script>
        <?php
    }
    //Si establezco conexión...
    else {
        return $mysqli;
    }
};
?>