document.addEventListener('DOMContentLoaded', function() {
    // Manejo de modales
    document.querySelectorAll('[data-open-modal]').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-open-modal');
            const modal = document.querySelector(`[data-modal-id="${modalId}"]`);
            if (modal) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100', 'pointer-events-auto');
            }
        });
    });

    document.querySelectorAll('[data-close-modal]').forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('[data-modal-id]');
            if (modal) {
                modal.classList.remove('opacity-100', 'pointer-events-auto');
                modal.classList.add('opacity-0', 'pointer-events-none');
            }
        });
    });

    // Cerrar modal al hacer clic fuera del contenido
    document.querySelectorAll('.transit').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('opacity-100', 'pointer-events-auto');
                this.classList.add('opacity-0', 'pointer-events-none');
            }
        });
    });
});