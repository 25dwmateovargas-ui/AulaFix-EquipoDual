// AulaFix — datos de ejemplo e interacción de interfaz (solo frontend, sin backend real)

const TICKETS = [
  { id: 'T1', titulo: 'Proyector no enciende', ubicacion: 'Aula 2.1', estado: 'abierto',
    descripcion: 'El proyector del aula 2.1 no da señal desde esta mañana. Se ha probado con otro cable HDMI y sigue sin funcionar.' },
  { id: 'T2', titulo: 'Silla rota', ubicacion: 'Aula 1.3', estado: 'en_progreso',
    descripcion: 'Una de las sillas de la última fila tiene una pata suelta y es inestable. Riesgo de caída.' },
  { id: 'T3', titulo: 'Ordenador va muy lento', ubicacion: 'Taller informática', estado: 'abierto',
    descripcion: 'El equipo nº 4 tarda más de 5 minutos en arrancar y se congela al abrir el navegador.' },
  { id: 'T4', titulo: 'Enchufe sin corriente', ubicacion: 'Biblioteca', estado: 'cerrado',
    descripcion: 'El enchufe junto a la mesa de lectura no daba corriente. Revisado por mantenimiento, ya funciona.' },
  { id: 'T5', titulo: 'Persiana atascada', ubicacion: 'Aula 2.1', estado: 'en_progreso',
    descripcion: 'La persiana del lado derecho no sube del todo, deja entrar demasiada luz para proyectar.' },
  { id: 'T6', titulo: 'Ratón no responde', ubicacion: 'Taller informática', estado: 'cerrado',
    descripcion: 'El ratón del equipo nº 7 no respondía. Se ha sustituido por uno nuevo.' },
];

const ESTADOS = {
  abierto: { label: 'Abierto', badge: 'badge-open' },
  en_progreso: { label: 'En progreso', badge: 'badge-progress' },
  cerrado: { label: 'Cerrado', badge: 'badge-closed' },
};

function showToast(msg) {
  let toast = document.querySelector('.toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg><span></span>`;
    document.body.appendChild(toast);
  }
  toast.querySelector('span').textContent = msg;
  toast.classList.add('show');
  clearTimeout(toast._timer);
  toast._timer = setTimeout(() => toast.classList.remove('show'), 2400);
}

/* ---------- Página: Login ---------- */
function initLogin() {
  const form = document.getElementById('login-form');
  if (!form) return;
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    window.location.href = 'lobby.html';
  });
}

/* ---------- Página: Listar tickets ---------- */
function initListar() {
  const list = document.getElementById('ticket-list');
  if (!list) return;

  const detail = document.getElementById('ticket-detail');
  const searchInput = document.getElementById('ticket-search');
  const filterSelect = document.getElementById('ticket-filter');
  let selectedId = TICKETS[0].id;

  function renderList() {
    const query = (searchInput.value || '').trim().toLowerCase();
    const filtro = filterSelect.value;

    const filtered = TICKETS.filter((t) => {
      const matchesText = !query || t.titulo.toLowerCase().includes(query) || t.ubicacion.toLowerCase().includes(query) || t.id.toLowerCase().includes(query);
      const matchesEstado = filtro === 'todos' || t.estado === filtro;
      return matchesText && matchesEstado;
    });

    if (filtered.length === 0) {
      list.innerHTML = `<li class="empty-list">No hay incidencias que coincidan con la búsqueda.</li>`;
      renderDetail(null);
      return;
    }

    list.innerHTML = filtered.map((t) => `
      <li>
        <button class="ticket-item ${t.id === selectedId ? 'active' : ''}" data-id="${t.id}">
          <span class="t-id">${t.id}</span>
          <span class="t-info">
            <span class="t-title">${t.titulo}</span>
            <span class="t-loc">${t.ubicacion}</span>
          </span>
        </button>
      </li>
    `).join('');

    if (!filtered.some((t) => t.id === selectedId)) {
      selectedId = filtered[0].id;
    }
    renderDetail(TICKETS.find((t) => t.id === selectedId));

    list.querySelectorAll('.ticket-item').forEach((btn) => {
      btn.addEventListener('click', () => {
        selectedId = btn.dataset.id;
        renderList();
      });
    });
  }

  function renderDetail(ticket) {
    if (!ticket) {
      detail.innerHTML = `<div class="empty-list">Selecciona una incidencia para ver el detalle.</div>`;
      return;
    }
    const estado = ESTADOS[ticket.estado];
    detail.innerHTML = `
      <div class="detail-head">
        <div>
          <h2>${ticket.titulo}</h2>
          <div class="detail-meta">
            <span>#${ticket.id}</span>
            <span>📍 ${ticket.ubicacion}</span>
          </div>
        </div>
        <span class="badge ${estado.badge}">${estado.label}</span>
      </div>
      <p class="detail-body">${ticket.descripcion}</p>
      <div>
        <label style="display:block;font-size:12.5px;font-weight:600;color:var(--text-dim);margin-bottom:10px;">Cambiar estado</label>
        <div class="state-actions">
          ${Object.entries(ESTADOS).map(([key, val]) => `
            <button class="state-btn ${key === ticket.estado ? 'is-current' : ''}" data-estado="${key}">${val.label}</button>
          `).join('')}
        </div>
      </div>
      <div class="detail-footer">
        <button class="btn btn-danger-ghost" id="delete-ticket">Eliminar incidencia</button>
      </div>
    `;

    detail.querySelectorAll('.state-btn').forEach((btn) => {
      btn.addEventListener('click', () => {
        ticket.estado = btn.dataset.estado;
        renderDetail(ticket);
        renderList();
        showToast(`Estado actualizado a "${ESTADOS[ticket.estado].label}"`);
      });
    });

    const delBtn = detail.querySelector('#delete-ticket');
    if (delBtn) {
      delBtn.addEventListener('click', () => {
        if (confirm(`¿Eliminar la incidencia ${ticket.id}? Esta acción no se puede deshacer.`)) {
          const idx = TICKETS.findIndex((t) => t.id === ticket.id);
          if (idx !== -1) TICKETS.splice(idx, 1);
          showToast('Incidencia eliminada');
          renderList();
        }
      });
    }
  }

  searchInput.addEventListener('input', renderList);
  filterSelect.addEventListener('change', renderList);
  renderList();
}

/* ---------- Página: Crear ticket ---------- */
function initCrear() {
  const form = document.getElementById('crear-form');
  if (!form) return;

  const campos = ['titulo', 'ubicacion', 'descripcion'];

  function validarCampo(id) {
    const input = document.getElementById(id);
    const field = input.closest('.field');
    const valido = input.value.trim().length >= (id === 'descripcion' ? 10 : 3);
    field.classList.toggle('has-error', !valido);
    return valido;
  }

  campos.forEach((id) => {
    document.getElementById(id).addEventListener('input', () => validarCampo(id));
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const todoValido = campos.map(validarCampo).every(Boolean);
    if (!todoValido) return;

    showToast('Incidencia creada correctamente');
    form.reset();
    campos.forEach((id) => document.getElementById(id).closest('.field').classList.remove('has-error'));
  });
}

/* ---------- Página: Buscar ticket ---------- */
function initBuscar() {
  const form = document.getElementById('buscar-form');
  if (!form) return;

  const input = document.getElementById('buscar-input');
  const resultArea = document.getElementById('result-area');

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const query = input.value.trim().toLowerCase();
    if (!query) return;

    const encontrado = TICKETS.find((t) => t.id.toLowerCase() === query || t.titulo.toLowerCase().includes(query));

    if (!encontrado) {
      resultArea.innerHTML = `
        <div class="no-result">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" style="display:inline-block"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/><path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          <p style="margin:0">No se ha encontrado ninguna incidencia para "<strong>${input.value}</strong>".</p>
        </div>`;
      return;
    }

    const estado = ESTADOS[encontrado.estado];
    resultArea.innerHTML = `
      <div class="result-card">
        <div class="detail-head" style="margin-bottom:14px;padding-bottom:14px;">
          <div>
            <h2 style="font-size:18px;margin:0 0 6px;">${encontrado.titulo}</h2>
            <div class="detail-meta"><span>#${encontrado.id}</span><span>📍 ${encontrado.ubicacion}</span></div>
          </div>
          <span class="badge ${estado.badge}">${estado.label}</span>
        </div>
        <p class="detail-body" style="margin-bottom:0;">${encontrado.descripcion}</p>
      </div>`;
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initLogin();
  initListar();
  initCrear();
  initBuscar();
});
