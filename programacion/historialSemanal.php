<?php
// ==========================================
// 1. CONSULTAR MEDICIONES DE LA SEMANA ACTUAL (GET)
// ==========================================
$conexion = mysqli_connect("localhost", "root", "", "silenciatedb");
$mediciones = [];
$weekDates = [];

if ($conexion) {
  mysqli_set_charset($conexion, "utf8");

  // Calcular las fechas de lunes a viernes de la semana actual
  $today = new DateTime();
  $dayOfWeek = (int)$today->format('N'); // 1 (Lunes) a 7 (Domingo)
  
  $monday = clone $today;
  if ($dayOfWeek > 1) {
    $monday->modify('-' . ($dayOfWeek - 1) . ' days');
  }

  $daysNames = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
  $monthsEs = [
    1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
  ];

  $conditions = [];
  for ($i = 0; $i < 5; $i++) {
    $currentDay = clone $monday;
    if ($i > 0) {
      $currentDay->modify('+' . $i . ' days');
    }
    $mesName = $monthsEs[(int)$currentDay->format('n')];
    $diaNum = $currentDay->format('j');
    
    $weekDates[$daysNames[$i]] = [
      "mes" => $mesName,
      "dia" => intval($diaNum)
    ];

    $escapedMes = mysqli_real_escape_string($conexion, $mesName);
    $escapedDia = mysqli_real_escape_string($conexion, $diaNum);
    $conditions[] = "(Mes = '$escapedMes' AND Dia = '$escapedDia')";
  }

  $whereClause = implode(" OR ", $conditions);
  $sql = "SELECT * FROM AgendaSonora WHERE $whereClause ORDER BY Hora ASC";
  
  $result = mysqli_query($conexion, $sql);
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
  <title>Silenciate | Historial Semanal</title>
  <meta name="description" content="Historial Semanal Inzilence — consulta las mediciones de ruido de esta semana.">
  <link rel="shortcut icon" href="imagenes/silenciate.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/historialsemanal.css?v=<?php echo time(); ?>">
  <script src="js/index.js"></script>
  <script>
    window.weekDates = <?php echo json_encode($weekDates); ?>;
    window.medicionesGuardadas = <?php echo json_encode($mediciones); ?>;
  </script>
</head>
<div id="negro"></div>
<body>
  <header>
    <nav>
      <img src="imagenes/logo.png" alt="logo" id="logo" onclick="window.location.href='menu.php'">
      <h1>HISTORIAL SEMANAL</h1>
    </nav>
  </header>

  <main>
    <div id="cuerda1" class="cuerdas"></div>
    <div id="cuerda2" class="cuerdas"></div>

    <div class="historial-wrap">
      <div class="week-grid">
        <!-- LUNES -->
        <div class="week-col" id="col-Lunes">
          <button class="day-header" onclick="toggleDay('Lunes')">LUNES</button>
          <div class="day-dropdown" id="dropdown-Lunes">
            <div class="grades-list" id="list-Lunes">
              <!-- Cargado dinámicamente -->
            </div>
            <button class="scroll-btn" onclick="scrollDay('Lunes')">
              <svg viewBox="0 0 24 24" width="24" height="24">
                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" fill="currentColor"/>
              </svg>
            </button>
          </div>
          <div class="day-tongue"></div>
        </div>

        <!-- MARTES -->
        <div class="week-col" id="col-Martes">
          <button class="day-header" onclick="toggleDay('Martes')">MARTES</button>
          <div class="day-dropdown" id="dropdown-Martes">
            <div class="grades-list" id="list-Martes">
              <!-- Cargado dinámicamente -->
            </div>
            <button class="scroll-btn" onclick="scrollDay('Martes')">
              <svg viewBox="0 0 24 24" width="24" height="24">
                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" fill="currentColor"/>
              </svg>
            </button>
          </div>
          <div class="day-tongue"></div>
        </div>

        <!-- MIERCOLES -->
        <div class="week-col" id="col-Miercoles">
          <button class="day-header" onclick="toggleDay('Miercoles')">MIERCOLES</button>
          <div class="day-dropdown" id="dropdown-Miercoles">
            <div class="grades-list" id="list-Miercoles">
              <!-- Cargado dinámicamente -->
            </div>
            <button class="scroll-btn" onclick="scrollDay('Miercoles')">
              <svg viewBox="0 0 24 24" width="24" height="24">
                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" fill="currentColor"/>
              </svg>
            </button>
          </div>
          <div class="day-tongue"></div>
        </div>

        <!-- JUEVES -->
        <div class="week-col" id="col-Jueves">
          <button class="day-header" onclick="toggleDay('Jueves')">JUEVES</button>
          <div class="day-dropdown" id="dropdown-Jueves">
            <div class="grades-list" id="list-Jueves">
              <!-- Cargado dinámicamente -->
            </div>
            <button class="scroll-btn" onclick="scrollDay('Jueves')">
              <svg viewBox="0 0 24 24" width="24" height="24">
                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" fill="currentColor"/>
              </svg>
            </button>
          </div>
          <div class="day-tongue"></div>
        </div>

        <!-- VIERNES -->
        <div class="week-col" id="col-Viernes">
          <button class="day-header" onclick="toggleDay('Viernes')">VIERNES</button>
          <div class="day-dropdown" id="dropdown-Viernes">
            <div class="grades-list" id="list-Viernes">
              <!-- Cargado dinámicamente -->
            </div>
            <button class="scroll-btn" onclick="scrollDay('Viernes')">
              <svg viewBox="0 0 24 24" width="24" height="24">
                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z" fill="currentColor"/>
              </svg>
            </button>
          </div>
          <div class="day-tongue"></div>
        </div>
      </div>
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

  <script src="js/historialsemanal.js"></script>
</body>
</html>