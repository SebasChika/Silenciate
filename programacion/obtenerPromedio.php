<?php
$conexion = mysqli_connect("localhost", "root", "", "silenciatedb");

if (!$conexion) {
    die("Error de conexión");
}

$resultado = mysqli_query($conexion, "SELECT PROMEDIO FROM promedioactual LIMIT 1");

if ($fila = mysqli_fetch_assoc($resultado)) {
    echo $fila["PROMEDIO"];
} else {
    echo "0";
}

mysqli_close($conexion);
?>