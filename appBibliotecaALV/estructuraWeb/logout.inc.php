<script>
    alert('La sesión se ha cerrado correctamente');
</script>
<?php
// Eliminamos las variables de sesión
session_unset();
// Eliminamos la sesión
session_destroy();
// Redirecionamos a index
header("refresh:0.2;url= " . $_SERVER["PHP_SELF"]);
?>