function mostrarSeccion(seccion) {
    document.getElementById('tipoEmpresa').classList.add('hidden');
    document.getElementById('listadoEmpresas').classList.add('hidden');

    document.getElementById(seccion).classList.remove('hidden');
}
window.mostrarSeccion = mostrarSeccion;
