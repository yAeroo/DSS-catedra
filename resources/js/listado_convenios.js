function mostrarSeccion(seccion) {
        document.getElementById('conConvenios').classList.add('hidden');
        document.getElementById('sinConvenios').classList.add('hidden');

        document.getElementById(seccion).classList.remove('hidden');
}
window.mostrarSeccion = mostrarSeccion;

//funcionalidad de boton recargar
function restablecerFiltros() {
        document.getElementById('busqueda').value = '';
        document.getElementById('filtroListado').selectedIndex = 0;
}

window.restablecerFiltros = restablecerFiltros;

//abrir modal
document.querySelectorAll('[data-open-modal]').forEach(btn => {
    btn.addEventListener('click', () => {
        const modalId = btn.getAttribute('data-open-modal');
        const modal = document.querySelector(`[data-modal-id="${modalId}"]`);
        if (modal) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
        }
    });
});

// Cerrar cualquier modal
document.querySelectorAll('[data-close-modal]').forEach(btn => {
    btn.addEventListener('click', () => {
        const modal = btn.closest('.transit');
        if (modal) {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }
    });
});