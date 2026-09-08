/**
 * calendario.js — Inzilence Agenda con mediciones de decibelios
 * ─────────────────────────────────────────────────────────────────────────────
 * Muestra bolitas azules en las fechas con mediciones y despliega el modal
 * con el desglose de datos correspondientes al hacer clic.
 * ─────────────────────────────────────────────────────────────────────────────
 */

const MONTH_NAMES = [
  'Enero','Febrero','Marzo','Abril','Mayo','Junio',
  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
];

const today    = new Date();
let   viewYear  = today.getFullYear();
let   viewMonth = today.getMonth();

function renderCalendar() {
  document.getElementById('cal-title').textContent =
    `${MONTH_NAMES[viewMonth]} ${viewYear}`;

  const grid = document.getElementById('cal-grid');
  grid.innerHTML = ''; 

  const totalDays = new Date(viewYear, viewMonth + 1, 0).getDate();

  for (let d = 1; d <= totalDays; d++) {
    const el = document.createElement('div');
    el.className = 'cal-day';
    el.setAttribute('aria-label', `${d} de ${MONTH_NAMES[viewMonth]}`);

    if (d === today.getDate() && viewMonth === today.getMonth() && viewYear === today.getFullYear()) {
      el.classList.add('today');
    }

    const numSpan = document.createElement('span');
    numSpan.className = 'day-number';
    numSpan.textContent = d;
    el.appendChild(numSpan);

    // Filtrar mediciones guardadas para este día y mes
    const dayMediciones = (window.medicionesGuardadas || []).filter(m => {
      return m.mes.trim().toLowerCase() === MONTH_NAMES[viewMonth].trim().toLowerCase() && 
             parseInt(m.dia) === d;
    });

    // Si existen mediciones, agregar bolita azul y listener de clic
    if (dayMediciones.length > 0) {
      const dot = document.createElement('span');
      dot.className = 'blue-dot';
      el.appendChild(dot);

      el.addEventListener('click', () => {
        showMedicionesModal(d, MONTH_NAMES[viewMonth], dayMediciones);
      });
    }

    grid.appendChild(el);
  }
}

// Mostrar modal con tabla de mediciones del día
function showMedicionesModal(dia, mes, data) {
  const modal = document.getElementById('mediciones-modal');
  const title = document.getElementById('modal-title');
  const cuerpo = document.getElementById('mediciones-cuerpo');
  
  title.textContent = `Mediciones del ${dia} de ${mes}`;
  cuerpo.innerHTML = '';
  
  data.forEach(m => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${m.hora}</td>
      <td><strong>${m.grupo}</strong></td>
      <td>${m.promedio} dB</td>
      <td>${m.min} dB</td>
      <td>${m.max} dB</td>
    `;
    cuerpo.appendChild(tr);
  });
  
  modal.style.display = 'flex';
}

function prevMonth() {
  viewMonth--;
  if (viewMonth < 0) { viewMonth = 11; viewYear--; }
  renderCalendar();
}

function nextMonth() {
  viewMonth++;
  if (viewMonth > 11) { viewMonth = 0; viewYear++; }
  renderCalendar();
}

function goToday() {
  viewYear  = today.getFullYear();
  viewMonth = today.getMonth();
  renderCalendar();
}

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('cal-prev').addEventListener('click', prevMonth);
  document.getElementById('cal-next').addEventListener('click', nextMonth);
  document.getElementById('cal-today').addEventListener('click', goToday);

  // Cerrar modal al hacer clic en el botón Cerrar
  const modal = document.getElementById('mediciones-modal');
  const closeBtn = document.getElementById('close-modal-btn');
  if (closeBtn && modal) {
    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });
  }

  renderCalendar();
});
