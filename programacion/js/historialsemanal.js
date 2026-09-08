/**
 * historialsemanal.js — Inzilence Historial Semanal con mediciones de decibelios
 * ─────────────────────────────────────────────────────────────────────────────
 * Organiza las mediciones de la semana actual por días (Lunes a Viernes) y
 * por grados (8, 9, 10, 11). Muestra los grados disponibles como botones.
 * Al hacer clic, abre un modal con el desglose detallado de las mediciones.
 * ─────────────────────────────────────────────────────────────────────────────
 */

// Mapear los nombres de los días en español
const DAYS = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];

document.addEventListener('DOMContentLoaded', () => {
  // 1. Inicializar y renderizar las columnas de la semana
  renderWeeklyData();

  // 2. Establecer el día activo por defecto (si hoy es de lunes a viernes, activar hoy; si no, Lunes)
  const today = new Date();
  const dayIndex = today.getDay(); // 0 = Domingo, 1 = Lunes, ..., 6 = Sábado
  let defaultDay = 'Lunes';
  
  if (dayIndex >= 1 && dayIndex <= 5) {
    defaultDay = DAYS[dayIndex - 1];
  }
  
  // Activar por defecto
  toggleDay(defaultDay);

  // 3. Configurar listeners del modal
  const modal = document.getElementById('mediciones-modal');
  const closeBtn = document.getElementById('close-modal-btn');
  if (closeBtn && modal) {
    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });
  }

  // Cerrar modal al hacer clic fuera del contenido
  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
});

/**
 * Organiza las mediciones por día y grado, y renderiza los botones en la interfaz.
 */
function renderWeeklyData() {
  const weekDates = window.weekDates || {};
  const allMediciones = window.medicionesGuardadas || [];

  DAYS.forEach(day => {
    const listEl = document.getElementById(`list-${day}`);
    const colEl = document.getElementById(`col-${day}`);
    
    if (!listEl) return;
    listEl.innerHTML = '';

    // Obtener la fecha del día actual según PHP
    const dateInfo = weekDates[day];
    if (!dateInfo) return;

    // Filtrar mediciones para este día específico
    const dayMediciones = allMediciones.filter(m => {
      return m.mes.trim().toLowerCase() === dateInfo.mes.trim().toLowerCase() &&
             parseInt(m.dia) === parseInt(dateInfo.dia);
    });

    // Si no hay mediciones, dejamos la lista vacía (o podríamos añadir un texto sutil)
    if (dayMediciones.length === 0) {
      listEl.innerHTML = '<div style="color: #6d635c; font-family: \'nise\'; font-size: 14px; text-align:center; padding: 15px 0;">Sin mediciones</div>';
      // Ocultar botón de scroll si no hay elementos
      const scrollBtn = colEl.querySelector('.scroll-btn');
      if (scrollBtn) scrollBtn.style.display = 'none';
      return;
    }

    // Agrupar mediciones por Grado
    // Mapeamos el grupo (ej. "11-1" -> "GRADO 11", "9-2" -> "GRADO 9")
    const gradesMap = {};
    dayMediciones.forEach(m => {
      const groupName = m.grupo.trim();
      let gradeLabel = groupName;

      // Intentar extraer el número de grado
      const match = groupName.match(/^(\d+)/);
      if (match) {
        gradeLabel = `GRADO ${match[1]}`;
      } else {
        gradeLabel = groupName.toUpperCase();
      }

      if (!gradesMap[gradeLabel]) {
        gradesMap[gradeLabel] = [];
      }
      gradesMap[gradeLabel].push(m);
    });

    // Obtener los grados y ordenarlos de forma descendente (11, 10, 9, 8...)
    const sortedGrades = Object.keys(gradesMap).sort((a, b) => {
      const numA = parseInt(a.replace(/\D/g, '')) || 0;
      const numB = parseInt(b.replace(/\D/g, '')) || 0;
      return numB - numA; // Descendente
    });

    // Renderizar botones de Grado
    sortedGrades.forEach(grade => {
      const btn = document.createElement('button');
      btn.className = 'grade-btn';
      btn.textContent = grade;
      
      // Evento para abrir el modal con el detalle
      btn.addEventListener('click', (e) => {
        e.stopPropagation(); // Evitar que se active el toggle del día al hacer clic en el botón
        showGradeMediciones(day, dateInfo.dia, dateInfo.mes, grade, gradesMap[grade]);
      });

      listEl.appendChild(btn);
    });

    // Mostrar/ocultar el botón de scroll dependiendo de la cantidad de elementos
    const scrollBtn = colEl.querySelector('.scroll-btn');
    if (scrollBtn) {
      if (sortedGrades.length > 4) {
        scrollBtn.style.display = 'flex';
      } else {
        scrollBtn.style.display = 'none';
      }
    }
  });
}

/**
 * Muestra el modal detallado con las mediciones de un grado específico en un día.
 */
function showGradeMediciones(dayName, dia, mes, gradeLabel, mediciones) {
  const modal = document.getElementById('mediciones-modal');
  const title = document.getElementById('modal-title');
  const cuerpo = document.getElementById('mediciones-cuerpo');

  if (!modal || !title || !cuerpo) return;

  title.textContent = `${gradeLabel} - ${dayName} ${dia} de ${mes}`;
  cuerpo.innerHTML = '';

  mediciones.forEach(m => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${m.hora}</td>
      <td><strong>${m.grupo}</strong></td>
      <td>${parseFloat(m.promedio).toFixed(1)} dB</td>
      <td>${parseFloat(m.min).toFixed(1)} dB</td>
      <td>${parseFloat(m.max).toFixed(1)} dB</td>
    `;
    cuerpo.appendChild(tr);
  });

  modal.style.display = 'flex';
}

/**
 * Expande la columna seleccionada y colapsa las demás (efecto acordeón).
 */
function toggleDay(selectedDay) {
  DAYS.forEach(day => {
    const colEl = document.getElementById(`col-${day}`);
    if (colEl) {
      if (day === selectedDay) {
        colEl.classList.add('active');
      } else {
        colEl.classList.remove('active');
      }
    }
  });
}

/**
 * Realiza un scroll suave hacia abajo en la lista de grados.
 */
function scrollDay(day) {
  const listEl = document.getElementById(`list-${day}`);
  if (listEl) {
    // Si llega al final, vuelve al inicio
    const isAtBottom = listEl.scrollHeight - listEl.scrollTop <= listEl.clientHeight + 10;
    if (isAtBottom) {
      listEl.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
      listEl.scrollBy({ top: 80, behavior: 'smooth' });
    }
  }
}
