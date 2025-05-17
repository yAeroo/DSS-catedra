//funcionalidad de cambion entre secciones
function mostrarSeccion(seccion) {
    document.getElementById('tipoEmpresa').classList.add('hidden');
    document.getElementById('listadoEmpresas').classList.add('hidden');

    document.getElementById(seccion).classList.remove('hidden');
}

window.mostrarSeccion = mostrarSeccion;

//funcionalidad de boton recargar
function restablecerFiltros() {
        document.getElementById('busqueda').value = '';
        document.getElementById('filtroListado').selectedIndex = 0;
}

window.restablecerFiltros = restablecerFiltros;
