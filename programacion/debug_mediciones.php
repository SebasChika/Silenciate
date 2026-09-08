<?php
// Archivo temporal de diagnóstico — borrar después de verificar
header("Content-Type: application/json");
$conexion = mysqli_connect("localhost", "root", "", "silenciatedb");
if (!$conexion) {
    echo json_encode(["error" => "Sin conexión: " . mysqli_connect_error()]);
    exit();
}
mysqli_set_charset($conexion, "utf8");

// Mostrar las tablas que existen
$tablas = [];
$res = mysqli_query($conexion, "SHOW TABLES");
while ($r = mysqli_fetch_row($res)) { $tablas[] = $r[0]; }

// Mostrar columnas de AgendaSonora si existe
$columnas = [];
$res2 = mysqli_query($conexion, "SHOW COLUMNS FROM AgendaSonora");
if ($res2) { while ($r = mysqli_fetch_assoc($res2)) { $columnas[] = $r; } }

// Mostrar los primeros 5 registros
$registros = [];
$res3 = mysqli_query($conexion, "SELECT * FROM AgendaSonora LIMIT 5");
if ($res3) { while ($r = mysqli_fetch_assoc($res3)) { $registros[] = $r; } }

echo json_encode([
    "tablas"    => $tablas,
    "columnas"  => $columnas,
    "registros" => $registros,
    "total"     => $res3 ? mysqli_num_rows($res3) : "error"
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
mysqli_close($conexion);
