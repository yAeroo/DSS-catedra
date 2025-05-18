<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de empresas</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a2d9a66d2a.js" crossorigin="anonymous"></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/listado_convenios.js'])
    @endif
</head>

<body class="bg-background min-h-screen relative">

    <div class="container mx-auto px-6 py-10 min-h-screen">
        <!-- Encabezado -->
        <div class="flex items-start justify-between mb-10">
            <div class="space-y-2">
                <a href="#" class="text-title hover:underline text-sm">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Regresar
                </a>
                <h1 class="text-3xl font-bold text-general">Listado de Convenios</h1>
            </div>
            <img src="{{ asset('img/logoFusalmoColored.png') }}" alt="Logo Fusalmo" class="h-12 lg:h-16">
        </div>

        <!-- Botón Agregar Convenio -->
        <div class="flex flex-wrap gap-4 mb-6">
            <button data-open-modal="modalAgregarConvenio"
                class="bg-botton text-background px-4 py-2 rounded-md shadow hover:bg-title transition">
                <i class="fa-solid fa-plus mr-2"></i>Agregar convenio
            </button>
        </div>

        <!-- Búsqueda y Filtro -->
        <div class="relative flex flex-wrap items-center justify-between gap-4 mb-6">
            <div class="relative max-w-sm flex-1">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-subtitle">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" id="busqueda" placeholder="Buscar..."
                    class="pl-10 pr-4 py-2 w-full bg-background text-general border border-background rounded-md shadow-sm text-sm focus:ring-title focus:border-title placeholder-subtitle">
            </div>
            <div class="flex items-center gap-2">
                <select id="filtroListado" class="bg-background border border-subtitle text-sm rounded-md px-3 py-2 text-subtitle shadow-sm focus:ring-title focus:border-title">
                    <option value="">Filtrar listado...</option>

                    <!-- Tipo de empresa -->
                    <option disabled class="font-semibold">─ Tipo de empresa ─</option>
                    <option value="empresa_multitarea">Organismos Multitarea</option>
                    <option value="empresa_bilaterales">Organismos Bilaterales</option>
                    <option value="empresa_gubernamentales">Instituciones Gubernamentales</option>

                    <!-- Sede -->
                    <option disabled class="font-semibold">─ Sede ─</option>
                    <option value="sede_san_salvador">San Salvador</option>
                    <option value="sede_santa_ana">Santa Ana</option>
                    <option value="sede_san_miguel">San Miguel</option>

                    <!-- Tipo de convenio -->
                    <option disabled class="font-semibold">─ Tipo de convenio ─</option>
                    <option value="convenio_proyecto">Proyecto</option>
                    <option value="convenio_consultoria">Consultoría</option>
                    <option value="convenio_donaciones">Donaciones</option>
                    <option value="convenio_acuerdo">Acuerdo</option>

                    <!-- Situación actual -->
                    <option disabled class="font-semibold">─ Situación actual ─</option>
                    <option value="situacion_activa">Activa</option>
                    <option value="situacion_finalizada">Finalizada</option>
                </select>

                <!-- Botón de recarga -->
                <button onclick="restablecerFiltros()" class="text-botton hover:text-title" title="Restablecer filtros">
                    <i class="fa-solid fa-rotate-right text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Botones de sección -->
        <div class="flex gap-4 mb-6">
            <button onclick="mostrarSeccion('conConvenios')" class="bg-background shadow-md px-6 py-3 rounded-xl text-general font-medium hover:bg-blue-100 transition">
                Empresas con convenios
            </button>
            <button onclick="mostrarSeccion('sinConvenios')" class="bg-background shadow-md px-6 py-3 rounded-xl text-general font-medium hover:bg-blue-100 transition">
                Empresas sin convenios
            </button>
        </div>

        <!-- Sección Empresas con Convenios -->
        <div id="conConvenios" class="bg-background rounded-xl shadow-md p-6 mb-10">
            <h2 class="text-xl font-semibold text-general mb-4">Empresas con convenios</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">N°</th>
                            <th class="px-4 py-2">Empresa</th>
                            <th class="px-4 py-2">Sede</th>
                            <th class="px-4 py-2">Situación actual</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-general">
                        <tr>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">TecnoGlobal</td>
                            <td class="px-4 py-2">San Salvador</td>
                            <td class="px-4 py-2">Activo</td>
                            <td class="px-4 py-2 space-x-2">
                                <button data-open-modal="modalDetalleConvenio"><i class="fa-solid fa-magnifying-glass text-general hover:text-botton"></i></button>
                                <button data-open-modal="modalEditarConvenio"><i class="fa-solid fa-pen text-botton hover:text-title"></i></button>
                                <button data-open-modal="modalSubirArchivo"><i class="fa-solid fa-cloud-arrow-up text-purple-600 hover:text-purple-800"></i></button>
                                <button data-open-modal="modalConfirmarEliminar"><i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sección Empresas sin Convenios -->
        <div id="sinConvenios" class="bg-background rounded-xl shadow-md p-6 hidden">
            <h2 class="text-xl font-semibold text-general mb-4">Empresas sin convenios</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">N°</th>
                            <th class="px-4 py-2">Empresa</th>
                            <th class="px-4 py-2">Sede</th>
                            <th class="px-4 py-2">Situación actual</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-background text-general">
                        <!-- Ejemplo -->
                        <tr>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">DataSoft</td>
                            <td class="px-4 py-2">Santa Ana</td>
                            <td class="px-4 py-2">Disponible</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Convenio -->
    <div data-modal-id="modalAgregarConvenio" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-background rounded-xl shadow-lg w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-general">
                    <i class="fa-solid fa-plus mr-2 text-botton"></i>Agregar convenio
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-subtitle hover:text-red-600 text-lg"></i>
                </button>
            </div>
            <!-- Subtítulo -->
            <p class="text-subtitle mb-6">Proporciona detalles sobre el convenio</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                <!-- Tipo de empresa -->
                <div>
                    <label class="block font-medium mb-1">Tipo de empresa</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>Organismos Multitarea</option>
                        <option>Organismos Bilaterales</option>
                        <option>Instituciones Gubernamentales</option>
                    </select>
                </div>

                <!-- Empresa -->
                <div>
                    <label class="block font-medium mb-1">mpresa</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>Empresa 1</option>
                        <option>Empresa 2</option>
                    </select>
                </div>

                <!-- Sede -->
                <div>
                    <label class="block font-medium mb-1">Sede</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>San Salvador</option>
                        <option>Santa Ana</option>
                        <option>San Miguel</option>
                    </select>
                </div>

                <!-- Correo electrónico -->
                <div>
                    <label class="block font-medium mb-1">Correo electrónico</label>
                    <input type="email" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="correo@ejemplo.com">
                </div>

                <!-- Nombre de contacto -->
                <div>
                    <label class="block font-medium mb-1">Nombre de contacto</label>
                    <input type="text" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="Nombre completo">
                </div>

                <!-- Situación actual -->
                <div>
                    <label class="block font-medium mb-1">Situación actual</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>Activa</option>
                        <option>Finalizada</option>
                    </select>
                </div>

                <!-- Número de contacto -->
                <div>
                    <label class="block font-medium mb-1">Número de contacto</label>
                    <input type="tel" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="Ej: +503 1234-5678">
                </div>

                <!-- Fecha de inicio -->
                <div>
                    <label class="block font-medium mb-1">Fecha de inicio</label>
                    <input type="date" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                </div>

                <!-- Tipo de convenio -->
                <div>
                    <label class="block font-medium mb-1">Tipo de convenio</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>Proyecto</option>
                        <option>Consultoría</option>
                        <option>Donaciones</option>
                        <option>Acuerdo</option>
                    </select>
                </div>

                <!-- Fecha de finalización -->
                <div>
                    <label class="block font-medium mb-1">Fecha de finalización</label>
                    <input type="date" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                </div>
            </div>
            <div class="mt-4">
                <label class="block font-medium mb-1 text-general">Convenio</label>
                <textarea rows="5" class="w-full border border-subtitle rounded-md px-3 py-2 text-general resize-y overflow-y-auto" placeholder="Detalles del convenio..."></textarea>
            </div>

            <!-- Checkbox -->
            <div class="mt-4 flex items-start gap-2">
                <input type="checkbox" id="documentacion" class="mt-1">
                <label for="documentacion" class="text-sm text-general">Este convenio está respaldado con documentación.</label>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2 mt-6">
                <button data-close-modal
                    class="min-w-[120px] px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Cancelar
                </button>
                <button class="min-w-[120px] px-4 py-2 bg-botton text-background rounded-md hover:bg-title transition">
                    Agregar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Detalles Convenio -->
    <div data-modal-id="modalDetalleConvenio" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-background rounded-xl shadow-lg w-[90vw] max-w-none p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-general">
                    <i class="fa-solid fa-magnifying-glass text-blue-600 mr-2"></i>Detalles del convenio
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-subtitle hover:text-red-600 text-lg"></i>
                </button>
            </div>

            <!-- Subtítulo -->
    <p class="text-subtitle mb-4">
      Consulta a detalle la información de un convenio y su empresa asociada
    </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 divide-x divide-subtitle text-sm text-gray-700">
                <!-- Columna izquierda -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pr-4">
                    <div>
                        <p class="font-semibold">Abreviatura:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">INTEC</div>
                    </div>
                    <div>
                        <p class="font-semibold">Nombre de la empresa:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">InnovaTech</div>
                    </div>
                    <div>
                        <p class="font-semibold">Código donante:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">CD-1023</div>
                    </div>
                    <div>
                        <p class="font-semibold">Estado:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">Activo</div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de operación:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">Exportación</div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de empresa:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">Tecnología</div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de relación:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">Convenio estratégico</div>
                    </div>
                    <div>
                        <p class="font-semibold">Dirección:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">Av. Central, San Salvador</div>
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="space-y-4 pl-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold">Sede:</p>
                            <div class="border rounded-md p-2 bg-gray-50 text-subtitle">San Salvador</div>
                        </div>

                        <div>
                            <p class="font-semibold">Correo electrónico:</p>
                            <div class="border rounded-md p-2 bg-gray-50 text-subtitle">contacto@innovatech.com</div>
                        </div>

                        <div>
                            <p class="font-semibold">Nombre de contacto:</p>
                            <div class="border rounded-md p-2 bg-gray-50 text-subtitle">María López</div>
                        </div>

                        <div>
                            <p class="font-semibold">Situación actual:</p>
                            <div class="border rounded-md p-2 bg-gray-50 text-subtitle">Activa</div>
                        </div>

                        <div>
                            <p class="font-semibold">Número de contacto:</p>
                            <div class="border rounded-md p-2 bg-gray-50 text-subtitle">+503 7123-4567</div>
                        </div>

                        <div>
                            <p class="font-semibold">Fecha de inicio:</p>
                            <div class="border rounded-md p-2 bg-gray-50 text-subtitle">2024-01-15</div>
                        </div>

                        <div>
                            <p class="font-semibold">Tipo de convenio:</p>
                            <div class="border rounded-md p-2 bg-gray-50 text-subtitle">Consultoría</div>
                        </div>

                        <div>
                            <p class="font-semibold">Fecha de finalización:</p>
                            <div class="border rounded-md p-2 bg-gray-50 text-subtitle">2025-12-20</div>
                        </div>
                    </div>


                    <!-- Convenio -->
                    <div>
                        <p class="font-semibold">Convenio:</p>
                        <div class="border rounded-md p-2 bg-gray-50 text-subtitle">
                            Consultoría para desarrollo tecnológico en sector educativo.
                        </div>
                    </div>


                    <!-- Indicadores -->
                    <div class="mt-2 space-y-2 text-sm text-general">
                        <p><i class="fa-solid fa-shield-check text-green-600 mr-2"></i>Este convenio está respaldado con documentación.</p>
                        <p><i class="fa-solid fa-cloud-check text-green-600 mr-2"></i>Este convenio cuenta con un respaldo.</p>
                    </div>

                    <!-- Botón descargar -->
                    <div class="mt-2">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            <i class="fa-solid fa-download mr-2"></i>Descargar archivo
                        </button>
                    </div>

                    <!-- Fechas -->
                    <div class="mt-4 flex flex-col sm:flex-row gap-4">
                        <div class="w-full">
                            <label class="block font-medium mb-1">Fecha de registro</label>
                            <input type="date" value="2024-11-10" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        </div>
                        <div class="w-full">
                            <label class="block font-medium mb-1">Fecha de última modificación</label>
                            <input type="date" value="2025-05-14" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón cerrar -->
            <div class="flex justify-end gap-2 mt-6">
                <button data-close-modal class="min-w-[120px] px-4 py-2 bg-botton text-background rounded-md hover:bg-title transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>


    <!-- Modal Editar Convenio -->
    <div data-modal-id="modalEditarConvenio" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-background rounded-xl shadow-lg w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-general">
                    <i class="fa-solid fa-pen text-blue-600 hover:text-blue-800"></i>Editar información del convenio
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-subtitle hover:text-red-600 text-lg"></i>
                </button>
            </div>
            <!-- Subtítulo -->
            <p class="text-subtitle mb-6">Puedes modificar la información del convenio</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                <!-- Tipo de empresa -->
                <div>
                    <label class="block font-medium mb-1">Tipo de empresa</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>Organismos Multitarea</option>
                        <option>Organismos Bilaterales</option>
                        <option>Instituciones Gubernamentales</option>
                    </select>
                </div>

                <!-- Empresa -->
                <div>
                    <label class="block font-medium mb-1">Empresa</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>BID | Banco Interamericano</option>
                        <option>Empresa 2</option>
                    </select>
                </div>

                <!-- Sede -->
                <div>
                    <label class="block font-medium mb-1">Sede</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>San Salvador</option>
                        <option>Santa Ana</option>
                        <option>San Miguel</option>
                    </select>
                </div>

                <!-- Correo electrónico -->
                <div>
                    <label class="block font-medium mb-1">Correo electrónico</label>
                    <input type="email" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="correo@ejemplo.com">
                </div>

                <!-- Nombre de contacto -->
                <div>
                    <label class="block font-medium mb-1">Nombre de contacto</label>
                    <input type="text" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="Nombre completo">
                </div>

                <!-- Situación actual -->
                <div>
                    <label class="block font-medium mb-1">Situación actual</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>Activa</option>
                        <option>Finalizada</option>
                    </select>
                </div>

                <!-- Número de contacto -->
                <div>
                    <label class="block font-medium mb-1">Número de contacto</label>
                    <input type="tel" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="Ej: +503 1234-5678">
                </div>

                <!-- Fecha de inicio -->
                <div>
                    <label class="block font-medium mb-1">Fecha de inicio</label>
                    <input type="date" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                </div>

                <!-- Tipo de convenio -->
                <div>
                    <label class="block font-medium mb-1">Tipo de convenio</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>Proyecto</option>
                        <option>Consultoría</option>
                        <option>Donaciones</option>
                        <option>Acuerdo</option>
                    </select>
                </div>

                <!-- Fecha de finalización -->
                <div>
                    <label class="block font-medium mb-1">Fecha de finalización</label>
                    <input type="date" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                </div>
            </div>
            <div class="mt-4">
                <label class="block font-medium mb-1 text-general">Convenio</label>
                <textarea rows="5" class="w-full border border-subtitle rounded-md px-3 py-2 text-general resize-y overflow-y-auto" placeholder="Detalles del convenio..."></textarea>
            </div>

            <!-- Checkbox -->
            <div class="mt-4 flex items-start gap-2">
                <input type="checkbox" id="documentacion" class="mt-1">
                <label for="documentacion" class="text-sm text-general">Este convenio está respaldado con documentación.</label>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2 mt-6">
                <button data-close-modal
                    class="min-w-[120px] px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Cancelar
                </button>
                <button class="min-w-[120px] px-4 py-2 bg-botton text-background rounded-md hover:bg-title transition">
                    Actualizar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Subir Archivo -->
<div data-modal-id="modalSubirArchivo" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
  <div class="bg-background rounded-xl shadow-lg w-[90vw] max-w-xl p-6 max-h-[90vh] overflow-y-auto">
    
    <!-- Encabezado -->
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-general flex items-center">
        <i class="fa-solid fa-cloud-arrow-up text-blue-600 mr-2 text-xl"></i>
        Importar un archivo
      </h3>
      <button data-close-modal>
        <i class="fa-solid fa-xmark text-subtitle hover:text-red-600 text-lg"></i>
      </button>
    </div>

    <!-- Subtítulo -->
    <p class="text-subtitle mb-4">
      Carga un archivo para respaldar tu convenio digitalmente
    </p>

    <!-- Advertencia: Ya respaldado -->
    <div class="flex items-start gap-2 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded-md p-4 mb-4 text-sm">
      <i class="fa-solid fa-triangle-exclamation mt-1"></i>
      <p>
        El convenio actual ya está respaldado digitalmente.
        Al registrar un nuevo documento, se actualizará el anterior.
      </p>
    </div>

    <!-- Advertencia: Eliminar respaldo -->
    <div class="flex items-start gap-2 bg-red-100 border border-red-300 text-red-800 rounded-md p-4 mb-4 text-sm">
      <i class="fa-solid fa-trash mt-1"></i>
      <p>
        ¿Desea eliminar el archivo de respaldo del convenio actual?
      </p>
    </div>

    <!-- Área para subir archivo -->
    <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md bg-gray-50 p-6 cursor-pointer hover:bg-gray-100 transition">
      <i class="fa-solid fa-upload text-2xl text-gray-500 mb-2"></i>
      <p class="text-sm text-gray-600">Sube tu archivo aquí</p>
      <input type="file" class="hidden" />
    </div>

    <div class="flex justify-end gap-2 mt-6">
      <button data-close-modal
                    class="min-w-[120px] px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Cancelar
                </button>
      <button class="min-w-[150px] px-4 py-2 bg-botton text-white rounded-md hover:bg-title transition">
        Guardar
      </button>
    </div>
  </div>
</div>

<!-- Modal Confirmación de Eliminación de convenio -->
    <div data-modal-id="modalConfirmarEliminar" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-general">
                    <i class="fa-solid fa-triangle-exclamation text-red-600 mr-2"></i>Eliminar Convenio
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-subtitle hover:text-red-600"></i>
                </button>
            </div>
            <p class="text-general mb-4">¿Estás seguro de eliminar este convenio? <strong>Esta acción no se puede deshacer.</strong></p>
            <div class="flex justify-end gap-2">
                <button data-close-modal class="bg-gray-200 text-general px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Eliminar</button>
            </div>
        </div>
    </div>

</body>

</html>