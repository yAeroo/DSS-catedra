// Mostrar secciones
function mostrarSeccion(seccion, botonActivo) {
    // Ocultar todas las secciones
    $("#tipoEmpresa, #listadoEmpresas").addClass("hidden");
    $("#" + seccion).removeClass("hidden");

    // Quitar clase activa de todos los botones
    document.querySelectorAll(".seccion-btn").forEach(btn => {
        btn.classList.remove("bg-title", "text-white");
        btn.classList.add("bg-white", "text-gray-700");
    });

    // Agregar clase activa al botón clicado
    botonActivo.classList.remove("bg-white", "text-gray-700");
    botonActivo.classList.add("bg-title", "text-white");
}

window.mostrarSeccion = mostrarSeccion;

// Restablecer filtros
function restablecerFiltros() {
    $("#busqueda").val("");
    $("#filtroListado").prop("selectedIndex", 0);
}
window.restablecerFiltros = restablecerFiltros;

// Abrir modales
$("[data-open-modal]").on("click", function () {
    const modalId = $(this).data("open-modal");
    const $modal = $(`[data-modal-id="${modalId}"]`);
    $modal
        .removeClass("opacity-0 pointer-events-none")
        .addClass("opacity-100 pointer-events-auto");
});

// Cerrar modales
$("[data-close-modal]").on("click", function () {
    const $modal = $(this).closest(".transit");
    $modal
        .removeClass("opacity-100 pointer-events-auto")
        .addClass("opacity-0 pointer-events-none");
});