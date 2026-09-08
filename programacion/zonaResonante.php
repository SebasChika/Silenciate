<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/zonaResonante.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagenes/silenciate.ico" type="image/x-icon">
    <title>Silenciate | ZonaResonante</title>
</head>

<body>
    <audio id="realBad" loop src="audio/realBad.mp3"></audio>
    <audio id="bad" loop src="audio/bad.mp3"></audio>
    <audio id="medium" loop src="audio/medium.mp3"></audio>
    <audio id="good" loop src="audio/good.mp3"></audio>
    <audio id="yoBeep" src="imagenes/zonaResonante/beeps/sebasBeep.mp3"></audio>
    <div id="negro">
        <button id="empezarAnalisis">INICIAR ANALISIS</button>
    </div>
    <div id="texto">
        <h1>SEBASTIAN:</h1>
        <p id="cuento"></p>
    </div>
    <main>
        <div id="center">
            <div id="contenedor">
                <div id="headerContainer">
                    <h1 id="titulo">ZONA RESONANTE</h1>
                    <div id="derecha">
                        <div id="promedio">
                            <p>PROMEDIO</p>
                            <div id="contenedorPromedio">
                                <p id="actualDb">15</p>dB
                            </div>
                        </div>
                        <img onclick="irMenu()" src="imagenes/logo.png" id="logo">
                    </div>
                </div>
                <div id="historia">
                    <div id="personaje">
                    </div>

                </div>
    </main>

    <script src="js/zonaResonante.js"></script>
</body>

</html>