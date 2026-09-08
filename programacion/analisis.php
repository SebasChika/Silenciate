<?php
// Solo responde JSON si es una petición POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    // ==========================================
    // 1. CONEXIÓN A BASE DE DATOS
    // ==========================================
    $conexion = mysqli_connect("localhost", "root", "", "silenciatedb");

    if (!$conexion) {
        echo json_encode([
            "ok" => false,
            "error" => "Error de conexión con la base de datos"
        ]);
        exit();
    }

    mysqli_set_charset($conexion, "utf8");

    // ==========================================
    // 2. RECIBIR DATOS DE LA MEDICIÓN
    // ==========================================
    $mes = $_POST['mes'] ?? '';
    $dia = $_POST['dia'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $grupo = $_POST['grupo'] ?? '';
    $promedio = $_POST['promedio'] ?? '0.00';
    $min = $_POST['min'] ?? '0.00';
    $max = $_POST['max'] ?? '0.00';

    // ==========================================
    // 3. INSERTAR EN LA TABLA AgendaSonora
    // ==========================================
    $sql = "INSERT INTO AgendaSonora (
        Mes,
        Dia,
        Hora,
        Grupo,
        Promedio,
        Min,
        Max
    ) VALUES (
        '$mes',
        '$dia',
        '$hora',
        '$grupo',
        '$promedio',
        '$min',
        '$max'
    )";

    $ok = mysqli_query($conexion, $sql);

    // ==========================================
    // 4. REEMPLAZAR PROMEDIO ACTUAL Y ACUMULAR TOTALES
    // ==========================================

    // Borra el registro anterior de promedioactual
    mysqli_query($conexion, "DELETE FROM promedioactual");

    // Inserta el nuevo promedio actual
    mysqli_query($conexion, "
        INSERT INTO promedioactual (PROMEDIO)
        VALUES ('$promedio')
    ");

mysqli_query($conexion, "
    INSERT INTO promediototal (id, numero, total) 
    VALUES (1, '$promedio', 1)
    ON DUPLICATE KEY UPDATE 
        numero = numero + '$promedio', 
        total = total + 1
");
$grado = explode('-', $grupo)[0];

mysqli_query($conexion, "
    UPDATE promedios_grado
    SET suma = suma + '$promedio',
        cantidad = cantidad + 1
    WHERE grado = '$grado'
");

    // ==========================================
    // 5. RESPUESTA JSON
    // ==========================================
    echo json_encode([
        "ok" => $ok,
        "error" => mysqli_error($conexion)
    ]);

    mysqli_close($conexion);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagenes/silenciate.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/analisis.css">
    <title>Silenciate | Análisis</title>
</head>
<body>
    <!-- Encabezado superior con estilo idéntico al solicitado -->
    <header class="header-analisis">
        <div class="header-left">
            <!-- Icono del logotipo de la aplicación -->
            <img src="imagenes/logo.png" alt="logo" id="header-logo" onclick="window.location.href='menu.php'">
        </div>
        <div class="header-center">
            <h1>ANÁLISIS</h1>
        </div>
        <div class="header-right">
            <!-- Botón opcional o vacío para centrar el título -->
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="main-container">
        <!-- Panel Izquierdo: Tacómetro de decibelios -->
        <div class="gauge-card">
            <div class="gauge-wrapper">
                <!-- SVG del Tacómetro / Dial de decibelios -->
                <svg viewBox="0 0 200 120" class="gauge-svg">
                    <defs>
                        <!-- Gradiente azul para la escala del dial -->
                        <linearGradient id="gauge-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#2b4c7e" />
                            <stop offset="50%" stop-color="#4a8ae7" />
                            <stop offset="100%" stop-color="#8bb4f2" />
                        </linearGradient>
                    </defs>
                    <!-- Arco de fondo oscuro -->
                    <path d="M20 100 A 80 80 0 0 1 180 100" fill="none" stroke="#121622" stroke-width="12" stroke-linecap="round"/>
                    <!-- Arco de escala de decibelios -->
                    <path id="gauge-arc" d="M20 100 A 80 80 0 0 1 180 100" fill="none" stroke="url(#gauge-gradient)" stroke-width="8" stroke-dasharray="251" stroke-dashoffset="251" stroke-linecap="round"/>
                    
                    <!-- Divisiones/Líneas de escala -->
                    <line x1="20" y1="100" x2="30" y2="100" stroke="#31558c" stroke-width="2" />
                    <line x1="31.7" y1="70.6" x2="40.3" y2="75.6" stroke="#31558c" stroke-width="2" />
                    <line x1="61.7" y1="41.7" x2="68.8" y2="48.8" stroke="#31558c" stroke-width="2" />
                    <line x1="100" y1="20" x2="100" y2="30" stroke="#31558c" stroke-width="2" />
                    <line x1="138.3" y1="41.7" x2="131.2" y2="48.8" stroke="#31558c" stroke-width="2" />
                    <line x1="168.3" y1="70.6" x2="159.7" y2="75.6" stroke="#31558c" stroke-width="2" />
                    <line x1="180" y1="100" x2="170" y2="100" stroke="#31558c" stroke-width="2" />
                    
                    <!-- Aguja / Indicador triangular en el centro -->
                    <g id="needle-group">
                        <polygon points="100,100 96,100 100,55 104,100" fill="#6797e5" />
                        <circle cx="100" cy="100" r="6" fill="#31558c" />
                    </g>
                </svg>
                <!-- Valor numérico en el centro de la aguja -->
                <div class="db-text-overlay">
                    <span id="db-value">1DB</span>
                </div>
            </div>
            <!-- Pequeña etiqueta de estado -->
            <div id="status-label">Listo para comenzar</div>
        </div>

        <!-- Panel Derecho: Controles metálicos de la interfaz -->
        <div class="controls-card">
            <!-- Botón Comenzar análisis -->
            <button id="start-btn" class="metal-btn long-btn">Comenzar análisis</button>
            
            <!-- Fila de Grupo y Tiempo -->
            <div id="dos" class="controls-row">
                <button id="btn-group-select" class="metal-btn half-btn">Grupo ➤</button>
                <button id="btn-time-select" class="metal-btn half-btn">Tiempo ➤</button>
            </div>
            
            <!-- Botón Finalizar análisis -->
            <button id="stop-btn" class="metal-btn long-btn disabled" disabled>Finalizar análisis</button>
            
            <!-- Botón Volver al Menú -->
            <button onclick="window.location.href = 'menu.php'" class="metal-btn back-btn">Volver al Menú</button>
        </div>
    </main>

    <!-- Modal para Selección de Grupo -->
    <div id="group-modal" class="modal">
        <div class="modal-content">
            <h3>Selecciona tu Grupo</h3>
         <div class="group-grid">
    <button class="group-item" data-group="1-1">1-1</button>
    <button class="group-item" data-group="1-2">1-2</button>
    <button class="group-item" data-group="1-3">1-3</button>
    <button class="group-item" data-group="1-4">1-4</button>

    <button class="group-item" data-group="2-1">2-1</button>
    <button class="group-item" data-group="2-2">2-2</button>
    <button class="group-item" data-group="2-3">2-3</button>
    <button class="group-item" data-group="2-4">2-4</button>

    <button class="group-item" data-group="3-1">3-1</button>
    <button class="group-item" data-group="3-2">3-2</button>
    <button class="group-item" data-group="3-3">3-3</button>
    <button class="group-item" data-group="3-4">3-4</button>

    <button class="group-item" data-group="4-1">4-1</button>
    <button class="group-item" data-group="4-2">4-2</button>
    <button class="group-item" data-group="4-3">4-3</button>
    <button class="group-item" data-group="4-4">4-4</button>

    <button class="group-item" data-group="5-1">5-1</button>
    <button class="group-item" data-group="5-2">5-2</button>
    <button class="group-item" data-group="5-3">5-3</button>
    <button class="group-item" data-group="5-4">5-4</button>

    <button class="group-item" data-group="6-1">6-1</button>
    <button class="group-item" data-group="6-2">6-2</button>
    <button class="group-item" data-group="6-3">6-3</button>
    <button class="group-item" data-group="6-4">6-4</button>

    <button class="group-item" data-group="7-1">7-1</button>
    <button class="group-item" data-group="7-2">7-2</button>
    <button class="group-item" data-group="7-3">7-3</button>
    <button class="group-item" data-group="7-4">7-4</button>

    <button class="group-item" data-group="8-1">8-1</button>
    <button class="group-item" data-group="8-2">8-2</button>
    <button class="group-item" data-group="8-3">8-3</button>
    <button class="group-item" data-group="8-4">8-4</button>

    <button class="group-item" data-group="9-1">9-1</button>
    <button class="group-item" data-group="9-2">9-2</button>
    <button class="group-item" data-group="9-3">9-3</button>
    <button class="group-item" data-group="9-4">9-4</button>

    <button class="group-item" data-group="10-1">10-1</button>
    <button class="group-item" data-group="10-2">10-2</button>
    <button class="group-item" data-group="10-3">10-3</button>
    <button class="group-item" data-group="10-4">10-4</button>

    <button class="group-item" data-group="11-1">11-1</button>
    <button class="group-item" data-group="11-2">11-2</button>
    <button class="group-item" data-group="11-3">11-3</button>
    <button class="group-item" data-group="11-4">11-4</button>
</div>
            <button id="close-group-modal" class="modal-close-btn">Cancelar</button>
        </div>
    </div>

    <!-- Modal para Selección de Tiempo Personalizado -->
    <div id="time-modal" class="modal">
        <div class="modal-content">
            <h3>Tiempo de Medición</h3>
            <p>Elige el tiempo de medición en segundos:</p>
            <div class="time-selector-container">
                <input type="number" id="custom-time-input" min="1" max="300" value="10">
                <span class="seconds-label">segundos</span>
            </div>
            <div class="modal-buttons-row">
                <button id="confirm-time-btn" class="modal-action-btn">Aceptar</button>
                <button id="close-time-modal" class="modal-close-btn">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Modal de Resultados / Resumen -->
    <div id="results-modal" class="modal">
        <div class="modal-content">
            <h3>Resumen del Análisis</h3>
            <div class="results-summary">
                <div class="summary-item">
                    <span class="label">Grupo:</span>
                    <span id="res-group" class="value">-</span>
                </div>
                <div class="summary-item">
                    <span class="label">Fecha y Hora:</span>
                    <span id="res-date" class="value">-</span>
                </div>
                <div class="summary-item">
                    <span class="label">Promedio dB:</span>
                    <span id="res-avg" class="value">-</span>
                </div>
                <div class="summary-item">
                    <span class="label">Mínimo dB:</span>
                    <span id="res-min" class="value">-</span>
                </div>
                <div class="summary-item">
                    <span class="label">Máximo dB:</span>
                    <span id="res-max" class="value">-</span>
                </div>
            </div>
            <button id="close-results-modal" class="modal-action-btn">Cerrar</button>
        </div>
    </div>

    <script src="js/analisis_db.js"></script>
</body>
</html>
