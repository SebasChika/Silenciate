<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estadisticas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imagenes/silenciate.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silenciate | Estadisticas</title>
</head>

<body>
    <header>
        <img onclick="irMenu()" id="logo" src="imagenes/logo.png">
        <div id="centro">
            <h1>Estadisticas</h1>
        </div>
    </header>

    <main>
        <div id="negro"></div>

        <?php
        $db_host = "localhost";
        $db_usuario = "root";
        $db_clave = "";
        $db_nombre = "silenciatedb";

        $conexion = mysqli_connect($db_host, $db_usuario, $db_clave, $db_nombre);

        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        mysqli_set_charset($conexion, "utf8");

        $sql = "SELECT numero, total FROM promediototal WHERE id = 1";
        $resultado = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_assoc($resultado);

        $promedio = 0;

        if ($fila && $fila["total"] > 0) {
            $promedio = $fila["numero"] / $fila["total"];
        }

        $sqlGrados = "SELECT grado, suma, cantidad FROM promedios_grado ORDER BY id";
        $resultadoGrados = mysqli_query($conexion, $sqlGrados);

        $promediosGrado = [];

        while ($filaGrado = mysqli_fetch_assoc($resultadoGrados)) {
            $promedioGrado = 0;

            if ($filaGrado["cantidad"] > 0) {
                $promedioGrado = $filaGrado["suma"] / $filaGrado["cantidad"];
            }

            $promediosGrado[$filaGrado["grado"]] = round($promedioGrado, 2);
        }
        ?>

        <div id="Prom">
            <img id="imagen" src="imagenes/zonaResonante/personajes/villada.gif">

            <div style="top: 0px; left: 0px" class="container-espiral">
                <aside style="--r: 1" class="loader">
                    <span style="--i: 1" class="circulo"></span>
                    <span style="--i: 2" class="circulo"></span>
                    <span style="--i: 3" class="circulo"></span>
                    <span style="--i: 4" class="circulo"></span>
                    <span style="--i: 5" class="circulo"></span>
                    <span style="--i: 6" class="circulo"></span>
                    <span style="--i: 7" class="circulo"></span>
                    <span style="--i: 8" class="circulo"></span>
                    <span style="--i: 9" class="circulo"></span>
                    <span style="--i: 10" class="circulo"></span>
                    <span style="--i: 11" class="circulo"></span>
                    <span style="--i: 12" class="circulo"></span>
                    <span style="--i: 13" class="circulo"></span>
                    <span style="--i: 14" class="circulo"></span>
                    <span style="--i: 15" class="circulo"></span>
                    <span style="--i: 16" class="circulo"></span>
                    <span style="--i: 17" class="circulo"></span>
                    <span style="--i: 18" class="circulo"></span>
                    <span style="--i: 19" class="circulo"></span>
                    <span style="--i: 20" class="circulo"></span>
                </aside>

                <aside style="--r: 2" class="loader">
                    <span style="--i: 1" class="circulo"></span>
                    <span style="--i: 2" class="circulo"></span>
                    <span style="--i: 3" class="circulo"></span>
                    <span style="--i: 4" class="circulo"></span>
                    <span style="--i: 5" class="circulo"></span>
                    <span style="--i: 6" class="circulo"></span>
                    <span style="--i: 7" class="circulo"></span>
                    <span style="--i: 8" class="circulo"></span>
                    <span style="--i: 9" class="circulo"></span>
                    <span style="--i: 10" class="circulo"></span>
                    <span style="--i: 11" class="circulo"></span>
                    <span style="--i: 12" class="circulo"></span>
                    <span style="--i: 13" class="circulo"></span>
                    <span style="--i: 14" class="circulo"></span>
                    <span style="--i: 15" class="circulo"></span>
                    <span style="--i: 16" class="circulo"></span>
                    <span style="--i: 17" class="circulo"></span>
                    <span style="--i: 18" class="circulo"></span>
                    <span style="--i: 19" class="circulo"></span>
                    <span style="--i: 20" class="circulo"></span>
                </aside>

                <aside style="--r: 3" class="loader">
                    <span style="--i: 1" class="circulo"></span>
                    <span style="--i: 2" class="circulo"></span>
                    <span style="--i: 3" class="circulo"></span>
                    <span style="--i: 4" class="circulo"></span>
                    <span style="--i: 5" class="circulo"></span>
                    <span style="--i: 6" class="circulo"></span>
                    <span style="--i: 7" class="circulo"></span>
                    <span style="--i: 8" class="circulo"></span>
                    <span style="--i: 9" class="circulo"></span>
                    <span style="--i: 10" class="circulo"></span>
                    <span style="--i: 11" class="circulo"></span>
                    <span style="--i: 12" class="circulo"></span>
                    <span style="--i: 13" class="circulo"></span>
                    <span style="--i: 14" class="circulo"></span>
                    <span style="--i: 15" class="circulo"></span>
                    <span style="--i: 16" class="circulo"></span>
                    <span style="--i: 17" class="circulo"></span>
                    <span style="--i: 18" class="circulo"></span>
                    <span style="--i: 19" class="circulo"></span>
                    <span style="--i: 20" class="circulo"></span>
                </aside>

                <aside style="--r: 4" class="loader">
                    <span style="--i: 1" class="circulo"></span>
                    <span style="--i: 2" class="circulo"></span>
                    <span style="--i: 3" class="circulo"></span>
                    <span style="--i: 4" class="circulo"></span>
                    <span style="--i: 5" class="circulo"></span>
                    <span style="--i: 6" class="circulo"></span>
                    <span style="--i: 7" class="circulo"></span>
                    <span style="--i: 8" class="circulo"></span>
                    <span style="--i: 9" class="circulo"></span>
                    <span style="--i: 10" class="circulo"></span>
                    <span style="--i: 11" class="circulo"></span>
                    <span style="--i: 12" class="circulo"></span>
                    <span style="--i: 13" class="circulo"></span>
                    <span style="--i: 14" class="circulo"></span>
                    <span style="--i: 15" class="circulo"></span>
                    <span style="--i: 16" class="circulo"></span>
                    <span style="--i: 17" class="circulo"></span>
                    <span style="--i: 18" class="circulo"></span>
                    <span style="--i: 19" class="circulo"></span>
                    <span style="--i: 20" class="circulo"></span>
                </aside>
            </div>

            <div id="left">
                <div id="promedioCompleto">
                    <p class="textoo">Promedio del colegio</p>

                    <div id="topp">
                        <h1 class="textooo"><?php echo round($promedio, 2); ?>dB</h1>

                        <div id="barra">
                            <div id="contenidoBarra"></div>
                        </div>
                    </div>

                    <p id="info">El nivel del ruido del colegio es moderado
                    ¡¡Sigamos así para mejorar!!</p>
                </div>
            </div>
        </div>

        <div id="allChart">
            <div id="estadistica1">
                <h1>Promedios Jornada Tarde</h1>

                <div class="contenedorChart">
                    <canvas id="miPieChart"></canvas>
                </div>
            </div>

            <div id="estadistica2">
                <h1>Promedios Jornada Mañana</h1>

                <div id="contenedorChart">
                    <canvas id="miPieChart2"></canvas>
                </div>
            </div>
        </div>
        <div class="contenedorGrafica">
    <canvas id="miLineChart"></canvas>
</div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const promediosGrado = <?php echo json_encode($promediosGrado); ?>;
    </script>

    <script src="js/estadisticas.js"></script>
</body>

</html>