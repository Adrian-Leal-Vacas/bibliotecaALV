<?php
// Importaciones
include_once "establecerConexion.inc.php";
include_once "cerrarConexion.inc.php";
/**
 * Esta función busca los libros segun los parametros que le pongas siempre que no esten alquilados.
 * @param string $titulo=null Titulo del libro. Ejemplo: "El arte de ser nosotros"
 * @param string $autor=null Autor del libro. Ejemplo: "Inma Rubiales"
 * @param string $isbn=null ISBN del libro. Ejemplo: "978-84-08-26792-8"
 * @param string $editorial=null Editorial del libro. Ejemplo: "Editorial Planeta"
 * @return array $arrayResultados Retorna un array asociativo con los resultados obtenidos.
 */
function buscarLibros($titulo = null, $autor = null, $isbn = null, $editorial = null):array {
    try {
        $mysqli = establecerConexion();
        
        // Comenzamos construyendo la consulta base
        $sql = "SELECT * FROM libros WHERE enPrestamo IS NULL"; // Siempre verdadero para agregar condiciones dinámicamente

        // Verificamos si se proporciona el nombre
        if ($titulo != null) {
            $sql = $sql . " AND titulo LIKE '%$titulo%'";
        }

        // Verificamos si se proporciona el autor
        if ($autor != null) {
            $sql = $sql . " AND autor LIKE '%$autor%'";
        }

        // Verificamos si se proporciona el ISBN
        if ($isbn != null) {
            $sql = $sql . " AND isbn LIKE '%$isbn%'";
        }

        // Verificamos si se proporciona la editorial
        if ($editorial != null) {
            $sql = $sql . " AND editorial LIKE '%$editorial%'";
        }

        if ($titulo == null && $autor == null && $isbn == null && $editorial == null) {
            return [];
        } else {
            if ($resultado = mysqli_query($mysqli, $sql)) {
                $arrayResultados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
                /* Liberar el conjunto de resultados */
                mysqli_free_result($resultado);
                return $arrayResultados;
            }
        }
    } catch (Exception $e) {
        return [];
    } finally {
        cerrarConexion($mysqli);
    }
}
?>