let audioContext;
let analyser;
let microphone;
let dataArray;
let animationId;
let startTime;
let duration;
let timerId;
let measurements = [];
let isMeasuring = false;
let dbSuavizado = 30;

// Variables de Configuración de Medición
let selectedGroup = "";
let measurementTime = 10; // por defecto 10 segundos

// Elementos de la UI
const startBtn = document.getElementById('start-btn');
const stopBtn = document.getElementById('stop-btn');
const btnGroupSelect = document.getElementById('btn-group-select');
const btnTimeSelect = document.getElementById('btn-time-select');
const dbValueText = document.getElementById('db-value');
const statusLabel = document.getElementById('status-label');
const needleGroup = document.getElementById('needle-group');
const gaugeArc = document.getElementById('gauge-arc');

// Modales
const groupModal = document.getElementById('group-modal');
const timeModal = document.getElementById('time-modal');
const resultsModal = document.getElementById('results-modal');

// Configuración Inicial de UI
document.addEventListener('DOMContentLoaded', () => {
    console.log(document.getElementById('needle-group'));
    console.log(document.getElementById('gauge-arc'));
    // Inicializar botón de tiempo con el valor por defecto
    btnTimeSelect.textContent = `Tiempo: ${measurementTime}s ➤`;

    // Configurar los eventos de clic
    startBtn.addEventListener('click', startMeasurement);
    stopBtn.addEventListener('click', stopMeasurement);

    // Abrir modal de grupos
    btnGroupSelect.addEventListener('click', () => {
        groupModal.classList.add('show');
    });

    // Cerrar modal de grupos
    document.getElementById('close-group-modal').addEventListener('click', () => {
        groupModal.classList.remove('show');
    });

    // Seleccionar grupo
    const groupItems = document.querySelectorAll('.group-item');
    groupItems.forEach(item => {
        item.addEventListener('click', (e) => {
            selectedGroup = e.target.getAttribute('data-group');

            // Actualizar clase seleccionada
            groupItems.forEach(btn => btn.classList.remove('selected'));
            e.target.classList.add('selected');

            // Actualizar botón e interfaz
            btnGroupSelect.textContent = `Grupo: ${selectedGroup} ➤`;
            groupModal.classList.remove('show');
        });
    });

    // Abrir modal de tiempo
    btnTimeSelect.addEventListener('click', () => {
        document.getElementById('custom-time-input').value = measurementTime;
        timeModal.classList.add('show');
    });

    // Confirmar tiempo
    document.getElementById('confirm-time-btn').addEventListener('click', () => {
        const timeInputVal = parseInt(document.getElementById('custom-time-input').value);
        if (isNaN(timeInputVal) || timeInputVal < 1 || timeInputVal > 300) {
            alert('Por favor, selecciona un tiempo válido entre 1 y 300 segundos.');
            return;
        }
        measurementTime = timeInputVal;
        btnTimeSelect.textContent = `Tiempo: ${measurementTime}s ➤`;
        timeModal.classList.remove('show');
    });

    // Cerrar modal de tiempo
    document.getElementById('close-time-modal').addEventListener('click', () => {
        timeModal.classList.remove('show');
    });

    // Cerrar modal de resultados
    document.getElementById('close-results-modal').addEventListener('click', () => {
        resultsModal.classList.remove('show');
        window.location.href = "zonaResonante.php";
    });
});

// Empezar medición
async function startMeasurement() {
    if (!selectedGroup) {
        // Si no ha elegido grupo, abrimos el modal automáticamente
        groupModal.classList.add('show');
        statusLabel.textContent = 'Por favor selecciona un grupo';
        return;
    }

    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            audio: {
                echoCancellation: false,
                noiseSuppression: false,
                autoGainControl: false
            }
        });
        audioContext = new (window.AudioContext || window.webkitAudioContext)();
        analyser = audioContext.createAnalyser();
        analyser.fftSize = 2048;
        analyser.smoothingTimeConstant = 0.85;
        microphone = audioContext.createMediaStreamSource(stream);
        microphone.connect(analyser);

        dataArray = new Uint8Array(analyser.frequencyBinCount);
        measurements = [];
        dbSuavizado = 30;
        isMeasuring = true;

        // Ajustar botones
        startBtn.disabled = true;
        startBtn.classList.add('disabled');
        stopBtn.disabled = false;
        stopBtn.classList.remove('disabled');
        btnGroupSelect.disabled = true;
        btnGroupSelect.classList.add('disabled');
        btnTimeSelect.disabled = true;
        btnTimeSelect.classList.add('disabled');

        startTime = Date.now();
        duration = measurementTime * 1000;

        updateGauge();

        // Configurar temporizador automático
        timerId = setTimeout(() => {
            if (isMeasuring) stopMeasurement();
        }, duration);

    } catch (err) {
        console.error(err);
    }
}

// Detener medición
function stopMeasurement() {
    if (!isMeasuring) return;

    isMeasuring = false;
    clearTimeout(timerId);
    cancelAnimationFrame(animationId);

    if (audioContext) {
        audioContext.close();
    }

    // Restaurar estado de botones
    startBtn.disabled = false;
    startBtn.classList.remove('disabled');
    stopBtn.disabled = true;
    stopBtn.classList.add('disabled');
    btnGroupSelect.disabled = false;
    btnGroupSelect.classList.remove('disabled');
    btnTimeSelect.disabled = false;
    btnTimeSelect.classList.remove('disabled');

    statusLabel.textContent = "Medición finalizada";

    // Reset de aguja
    setNeedleAngle(-90);
    setArcDashOffset(251);

    if (measurements.length > 0) {
        saveData();
    }
}

// Bucle de actualización
function updateGauge() {

    if (!isMeasuring) return;

    analyser.getByteTimeDomainData(dataArray);

    let sum = 0;

    for (let i = 0; i < dataArray.length; i++) {
        let x = (dataArray[i] - 128) / 128;
        sum += x * x;
    }

    const rms = Math.sqrt(sum / dataArray.length);

    // Conversión a dB
    let db = 20 * Math.log10(rms || 0.000001);

    // Ajuste de calibración
    db += 60;
    //console.log("DB REAL:", db);

    // Suavizado
    dbSuavizado = dbSuavizado * 0.9 + db * 0.1;
    db = dbSuavizado;

    // Limitar rango
    if (db > 160) db = 160;
    if (db < 10) db = 10;
    dbValueText.textContent = `${Math.round(db)}DB`;

    // Omitir los primeros 500ms para permitir la inicialización del micrófono y evitar lecturas sesgadas
    const elapsedMs = Date.now() - startTime;
    if (elapsedMs > 500) {
        measurements.push(db);
    }

    // Actu

    // Rotar la aguja: 0 dB -> -90deg, 120 dB -> 90deg
    const angle = (db / 120) * 180 - 90;
    setNeedleAngle(angle);

    // Llenar el arco: dasharray = 251. 0 dB -> dashoffset 251, 120 dB -> dashoffset 0
    const dashOffset = 251 - (db / 120) * 251;
    setArcDashOffset(dashOffset);

    // Tiempo restante
    const elapsed = (Date.now() - startTime) / 1000;
    const remaining = Math.max(0, measurementTime - elapsed);
    statusLabel.textContent = `Medición activa - Restan ${Math.ceil(remaining)}s`;

    animationId = requestAnimationFrame(updateGauge);
}

// Modificar ángulo de la aguja SVG
function setNeedleAngle(angle) {
    needleGroup.style.transform = `rotate(${angle}deg)`;
}

// Modificar llenado del arco de tacómetro SVG
function setArcDashOffset(offset) {
    gaugeArc.style.strokeDashoffset = offset;
}

// Guardar los datos en el servidor
async function saveData() {
    const avg = measurements.reduce((a, b) => a + b, 0) / measurements.length;
    const min = Math.min(...measurements);
    const max = Math.max(...measurements);

    const now = new Date();

    // Obtener mes en formato texto largo en español
    const months = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];
    const mes = months[now.getMonth()];
    const dia = now.getDate();
    const hora = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

    // Preparar el cuerpo de la petición POST
    const data = new URLSearchParams();
    data.append('mes', mes);
    data.append('dia', dia);
    data.append('hora', hora);
    data.append('grupo', selectedGroup);
    data.append('promedio', avg.toFixed(2));
    data.append('min', min.toFixed(2));
    data.append('max', max.toFixed(2));

    try {
        statusLabel.textContent = "Guardando resultados...";
        const response = await fetch('analisis.php', {
            method: 'POST',
            body: data
        });
        const result = await response.json();

        if (result.ok) {
            // Mostrar Modal con Resultados
            document.getElementById('res-group').textContent = selectedGroup;
            document.getElementById('res-date').textContent = `${dia} de ${mes}, ${hora}`;
            document.getElementById('res-avg').textContent = `${avg.toFixed(1)} dB`;
            document.getElementById('res-min').textContent = `${min.toFixed(1)} dB`;
            document.getElementById('res-max').textContent = `${max.toFixed(1)} dB`;

            resultsModal.classList.add('show');
            statusLabel.textContent = "Datos guardados en Base de Datos";
            dbValueText.textContent = "0DB";
        } else {
            alert(`Error al guardar en Base de Datos: ${result.error}`);
            statusLabel.textContent = "Error al guardar";
        }
    } catch (err) {
        console.error("Error al enviar los datos del análisis:", err);
        alert("Error de red o conexión al intentar guardar.");
        statusLabel.textContent = "Error de conexión";
    }
}
