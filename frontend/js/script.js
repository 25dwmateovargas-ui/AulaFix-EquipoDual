// AulaFix — mejoras de interfaz en JavaScript (R04)

/* ---------- Página: Listar tickets — filtrado inmediato ---------- */
function initFiltradoInmediato() {
  const input = document.getElementById('buscador-texto');
  const lista = document.getElementById('lista-tickets');
  if (!input || !lista) return;

  const items = Array.from(lista.querySelectorAll('.ticket-item'));
  if (items.length === 0) return;

  let mensajeVacio = lista.querySelector('.empty-list');

  input.addEventListener('input', () => {
    const query = input.value.trim().toLowerCase();
    let visibles = 0;

    items.forEach((item) => {
      const texto = item.textContent.toLowerCase();
      const coincide = !query || texto.includes(query);
      item.closest('li').classList.toggle('hidden', !coincide);
      if (coincide) visibles++;
    });

    if (!mensajeVacio) {
      mensajeVacio = document.createElement('li');
      mensajeVacio.className = 'empty-list';
      mensajeVacio.textContent = 'No hay incidencias que coincidan con la búsqueda.';
      lista.appendChild(mensajeVacio);
    }
    mensajeVacio.classList.toggle('hidden', visibles !== 0);
  });
}

/* ---------- Página: Crear ticket — contador de caracteres ---------- */
function initContadorDescripcion() {
  const textarea = document.getElementById('descripcion');
  const contador = document.getElementById('contador-descripcion');
  if (!textarea || !contador) return;

  function actualizar() {
    const longitud = textarea.value.length;
    contador.textContent = `${longitud} caracteres`;
    contador.style.color = longitud < 10 ? 'var(--danger)' : 'var(--text-dim)';
  }

  textarea.addEventListener('input', actualizar);
  actualizar();
}

document.addEventListener('DOMContentLoaded', () => {
  initFiltradoInmediato();
  initContadorDescripcion();
});
