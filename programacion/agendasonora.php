<?php
// Solo responde JSON si es una petición POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  header("Content-Type: application/json");

  // =========================
  // 1. DEBUG DE TODO LO QUE LLEGA
  // =========================
  $debug = [
    "POST" => $_POST,
    "RAW_INPUT" => file_get_contents("php://input"),
    "REQUEST_METHOD" => $_SERVER["REQUEST_METHOD"]
  ];

  // =========================
  // 2. CONEXIÓN A BASE DE DATOS
  // =========================
  $conexion = mysqli_connect("localhost", "root", "", "silenciatedb");

  if (!$conexion) {
    echo json_encode([
      "ok" => false,
      "error" => "Error de conexión",
      "debug" => $debug
    ]);
    exit();
  }

  mysqli_set_charset($conexion, "utf8");

  // =========================
  // 3. RECIBIR DATOS
  // =========================
  $mes = $_POST['mes'] ?? '';
  $dia = $_POST['dia'] ?? '';
  $hora = $_POST['hora'] ?? '';
  $grupo = $_POST['grupo'] ?? '';
  $promedio = $_POST['promedio'] ?? '';
  $min = $_POST['min'] ?? '';
  $max = $_POST['max'] ?? '';

  // =========================
  // 4. INSERT
  // =========================
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

  // =========================
  // 5. RESPUESTA FINAL
  // =========================
  echo json_encode([
    "ok" => $ok,
    "mes" => $mes,
    "dia" => $dia,
    "hora" => $hora,
    "grupo" => $grupo,
    "promedio" => $promedio,
    "min" => $min,
    "max" => $max,
    "debug" => $debug,
    "sql_error" => mysqli_error($conexion)
  ]);

  mysqli_close($conexion);
  exit();
}

// ==========================================
// 6. CONSULTAR MEDICIONES PARA EL CALENDARIO (GET)
// ==========================================
$conexion = mysqli_connect("localhost", "root", "", "silenciatedb");
$mediciones = [];
if ($conexion) {
  mysqli_set_charset($conexion, "utf8");
  $result = mysqli_query($conexion, "SELECT * FROM AgendaSonora");
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $mediciones[] = [
        "mes" => $row['Mes'],
        "dia" => intval($row['Dia']),
        "hora" => $row['Hora'],
        "grupo" => $row['Grupo'],
        "promedio" => $row['Promedio'],
        "min" => $row['Min'],
        "max" => $row['Max']
      ];
    }
  }
  mysqli_close($conexion);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Silenciate | Agenda</title>
  <link rel="shortcut icon" href="imagenes/silenciate.ico" type="image/x-icon">
  <meta name="description" content="Agenda musical Inzilence — organiza tus eventos y ensayos.">
  <link rel="stylesheet" href="css/agendaSemanal.css?v=<?php echo time(); ?>">
  <script src="js/index.js"></script>
  <script>
    window.medicionesGuardadas = <?php echo json_encode($mediciones); ?>;
  </script>
</head>

<body>
  <div id="negro"></div>
  <header>
    <nav>
      <img onclick="irMenu()" src="imagenes/logo.png" alt="" id="logo">
      <h1>AGENDA SONORA</h1>
</nav>
  </header>

  <main>
    <div id="cuerda1" class="cuerdas"></div>
    <div id="cuerda2" class="cuerdas"></div>

    <div class="cal-wrap" id="calendario">

      <div class="cal-header">
        <button id="cal-prev" class="cal-btn" title="Mes anterior">&#8249;</button>
        <span id="cal-title" class="cal-title">Mes Año</span>
        <div class="cal-nav">
          <button id="cal-today" class="cal-btn today-btn">Hoy</button>
          <button id="cal-next" class="cal-btn" title="Mes siguiente">&#8250;</button>
        </div>
      </div>

      <div class="cal-grid" id="cal-grid"></div>
    </div>
  </main>

  <img src="imagenes/disco.png" alt="disco" id="disco">

  <!-- Modal de Mediciones -->
  <div id="mediciones-modal" class="modal" style="display: none;">
    <div class="modal-content">
      <h3 id="modal-title">Mediciones</h3>
      <div class="table-container">
        <table id="mediciones-tabla">
          <thead>
            <tr>
              <th>Hora</th>
              <th>Grupo</th>
              <th>Promedio</th>
              <th>Mín</th>
              <th>Máx</th>
            </tr>
          </thead>
          <tbody id="mediciones-cuerpo">
            <!-- Se llenará dinámicamente -->
          </tbody>
        </table>
      </div>
      <button id="close-modal-btn" class="modal-close-btn">Cerrar</button>
    </div>
  </div>

  <script src="js/analisis.js"></script>
  <script src="js/calendario.js"></script>
</body>

</html>