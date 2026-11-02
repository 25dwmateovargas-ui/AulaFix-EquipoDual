// AulaFix — mejoras de interfaz en JavaScript (POO + eventos/validación)

/* ---------- Página: Listar tickets — filtrado inmediato ---------- */
class FiltroTickets {
  constructor(input, lista) {
    this.input = input;
    this.lista = lista;
    this.mensajeVacio = lista.querySelector('.empty-list');

    // Array de objetos incidencia, construido a partir de los data-* del DOM.
    this.incidencias = Array.from(lista.querySelectorAll('.ticket-item')).map((elemento) => ({
      id: elemento.dataset.id,
      titulo: elemento.dataset.titulo ?? '',
      ubicacion: elemento.dataset.ubicacion ?? '',
      estado: elemento.dataset.estado ?? '',
      elemento,
    }));
  }

  crearMensajeVacio() {
    const li = document.createElement('li');
    li.className = 'empty-list';
    li.textContent = 'No hay incidencias que coincidan con la búsqueda.';
    this.lista.appendChild(li);
    return li;
  }

  buscarCoincidencias(query) {
    if (!query) return this.incidencias;

    return this.incidencias.filter((incidencia) =>
      [incidencia.titulo, incidencia.ubicacion, incidencia.estado]
        .join(' ')
        .toLowerCase()
        .includes(query)
    );
  }

  filtrar() {
    const query = this.input.value.trim().toLowerCase();
    const coincidencias = this.buscarCoincidencias(query);
    const idsVisibles = new Set(coincidencias.map((incidencia) => incidencia.id));

    this.incidencias.forEach((incidencia) => {
      incidencia.elemento
        .closest('li')
        .classList.toggle('hidden', !idsVisibles.has(incidencia.id));
    });

    if (!this.mensajeVacio) {
      this.mensajeVacio = this.crearMensajeVacio();
    }
    this.mensajeVacio.classList.toggle('hidden', coincidencias.length !== 0);
  }

  limpiar() {
    this.input.value = '';
    this.filtrar();
  }

  init() {
    if (this.incidencias.length === 0) return;

    this.input.addEventListener('input', () => this.filtrar());

    this.input.addEventListener('keydown', (evento) => {
      if (evento.key === 'Escape' && !evento.isComposing) {
        this.limpiar();
      }
    });
  }
}

/* ---------- Página: Crear ticket — contador de caracteres ---------- */
class ContadorCaracteres {
  constructor(textarea, contador, minimo) {
    this.textarea = textarea;
    this.contador = contador;
    this.minimo = minimo;
  }

  actualizar() {
    const longitud = this.textarea.value.length;
    this.contador.textContent = `${longitud} caracteres`;
    this.contador.style.color = longitud < this.minimo ? 'var(--danger)' : 'var(--text-dim)';
  }

  init() {
    this.textarea.addEventListener('input', () => this.actualizar());
    this.actualizar();
  }
}

/* ---------- Página: Crear ticket — validación con FormData y validez nativa ---------- */
class ValidadorFormulario {
  constructor(form, reglas) {
    this.form = form;
    this.reglas = reglas; // { idCampo: longitudMinima }
  }

  validarCampo(id) {
    const campo = document.getElementById(id);
    if (!campo) return true;

    campo.setCustomValidity('');

    const valido = campo.value.trim().length >= this.reglas[id];
    if (!valido) {
      campo.setCustomValidity(`Este campo necesita al menos ${this.reglas[id]} caracteres.`);
    }

    campo.closest('.field').classList.toggle('has-error', !valido);
    return valido;
  }

  validarTodo() {
    return Object.keys(this.reglas)
      .map((id) => this.validarCampo(id))
      .every(Boolean);
  }

  init() {
    Object.keys(this.reglas).forEach((id) => {
      const campo = document.getElementById(id);
      if (campo) {
        campo.addEventListener('input', () => this.validarCampo(id));
      }
    });

    this.form.addEventListener('submit', (evento) => {
      this.validarTodo();
      if (!this.form.reportValidity()) {
        evento.preventDefault();
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const inputBusqueda = document.getElementById('buscador-texto');
  const listaTickets = document.getElementById('lista-tickets');
  if (inputBusqueda && listaTickets) {
    new FiltroTickets(inputBusqueda, listaTickets).init();
  }

  const textareaDescripcion = document.getElementById('descripcion');
  const contadorDescripcion = document.getElementById('contador-descripcion');
  if (textareaDescripcion && contadorDescripcion) {
    new ContadorCaracteres(textareaDescripcion, contadorDescripcion, 10).init();
  }

  const formCrear = document.getElementById('crear-form');
  if (formCrear) {
    new ValidadorFormulario(formCrear, { titulo: 3, ubicacion: 2, descripcion: 10 }).init();
  }
});
