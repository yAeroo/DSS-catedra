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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/gestion_empresas.js'])
    @endif
</head>

<body class="bg-gray-50 min-h-screen relative">

    <div class="container mx-auto px-6 py-10 min-h-screen">
        <!-- Encabezado -->
        <div class="flex items-start justify-between mb-10">
            <div class="space-y-2">
                <a href="#" class="text-blue-700 hover:underline text-sm">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Regresar
                </a>
                <h1 class="text-3xl font-bold text-gray-800">Gestión de empresas</h1>
            </div>
            <img src="{{ asset('img/logoFusalmoColored.png') }}" alt="Logo Fusalmo" class="h-12 lg:h-16">
        </div>

        <!-- Botones agregar -->
        <div class="flex flex-wrap gap-4 mb-6">
            <button data-open-modal="modalAgregarTipo"
                class="bg-blue-700 text-white px-4 py-2 rounded-md shadow hover:bg-blue-800 transition">
                <i class="fa-solid fa-plus mr-2"></i>Agregar tipo de empresa
            </button>
            <button data-open-modal="modalAgregarEmpresa"
                class="bg-green-700 text-white px-4 py-2 rounded-md shadow hover:bg-green-800 transition">
                <i class="fa-solid fa-plus mr-2"></i>Agregar empresa
            </button>
        </div>


        <!-- Búsqueda y Filtro -->
        <div class="relative flex flex-wrap items-center justify-between gap-4 mb-6">
            <div class="relative max-w-sm flex-1">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" id="busqueda" placeholder="Buscar..."
                    class="pl-10 pr-4 py-2 w-full bg-gray-100 text-gray-800 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500">
            </div>
            <div class="flex items-center gap-2">
                <select id="filtroListado" class="bg-white border border-gray-300 text-sm rounded-md px-3 py-2 text-gray-700 shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
                <button onclick="restablecerFiltros()" class="text-blue-700 hover:text-blue-900" title="Restablecer filtros">
                    <i class="fa-solid fa-rotate-right text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Botones sección -->
        <div class="flex gap-4 mb-6">
            <button onclick="mostrarSeccion('tipoEmpresa')" class="bg-white shadow-md px-6 py-3 rounded-xl text-gray-700 font-medium hover:bg-blue-100 transition">
                Tipo de empresa
            </button>
            <button onclick="mostrarSeccion('listadoEmpresas')" class="bg-white shadow-md px-6 py-3 rounded-xl text-gray-700 font-medium hover:bg-blue-100 transition">
                Listado de empresas
            </button>
        </div>

        <!-- Sección Tipo de empresa -->
        <div id="tipoEmpresa" class="bg-white rounded-xl shadow-md p-6 mb-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Tipo de empresa</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">N°</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Descripción</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <!-- Ejemplo de prueba -->
                    <tbody class="divide-y divide-gray-200  text-gray-700">
                        <tr>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">Tecnología</td>
                            <td class="px-4 py-2">Empresas dedicadas al desarrollo de software y hardware</td>
                            <td class="px-4 py-2 space-x-2">
                                <button data-open-modal="modalEditar">
                                    <i class="fa-solid fa-pen text-blue-600 hover:text-blue-800"></i>
                                </button>
                                <button data-open-modal="modalConfirmarEliminarr">
                                    <i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i>
                                </button>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sección Listado de empresas -->
        <div id="listadoEmpresas" class="bg-white rounded-xl shadow-md p-6 hidden">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Listado de empresas</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">N°</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Código donante</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>

                    <!-- Ejemplo de prueba -->
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        <tr>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">InnovaTech</td>
                            <td class="px-4 py-2">MULT-BID-2024</td>
                            <td class="px-4 py-2">Activo</td>
                            <td class="px-4 py-2 space-x-2">
                                <button data-open-modal="modalDetallesEmpresa">
                                    <i class="fa-solid fa-magnifying-glass text-gray-700 hover:text-blue-600"></i>
                                </button>
                                <button data-open-modal="modalEditarEmpresa">
                                    <i class="fa-solid fa-pen text-blue-600 hover:text-blue-800"></i>
                                </button>
                                <button data-open-modal="modalConfirmarEliminar">
                                    <i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- modales -->

    <!-- Modal Agregar Tipo de Empresa -->
    <div data-modal-id="modalAgregarTipo"
        class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fa-solid fa-plus mr-2 text-blue-700"></i>Agregar tipo de empresa
                </h3>
                <button data-close-modal aria-label="Cerrar modal">
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                </button>
            </div>

            <p class="text-gray-600 mb-6">Proporciona información sobre el tipo de empresa a registrar</p>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">N°</label>
                    <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" placeholder="ID automático o manual" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del tipo de empresa</label>
                    <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" placeholder="Nombre del tipo" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" rows="3" placeholder="Descripción del tipo"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button data-close-modal
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                        Cancelar
                    </button>
                    <button class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Empresa -->
    <div data-modal-id="modalAgregarEmpresa" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6">
            <!-- Encabezado -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fa-solid fa-plus mr-2 text-green-700"></i>Agregar empresa
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                </button>
            </div>

            <!-- Subtítulo -->
            <p class="text-gray-600 mb-6">Proporciona detalles sobre la empresa a registrar</p>

            <!-- Formulario -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Abreviatura</label>
                    <input type="text" class="w-full bg-gray-100 border border-gray-400 text-gray-800 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" placeholder="Ej: INTEC">
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nombre de la empresa</label>
                    <input type="text" class="w-full bg-gray-100 border border-gray-400 text-gray-800 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" placeholder="Ej: InnovaTech">
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Estado</label>
                    <select class="w-full bg-gray-100 border border-gray-400 text-gray-800 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option>Activa</option>
                        <option>Finalizada</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tipo de cooperación</label>
                    <select class="w-full bg-gray-100 border border-gray-400 text-gray-800 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option>Multilateral</option>
                        <option></option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tipo de relación</label>
                    <select class="w-full bg-gray-100 border border-gray-400 text-gray-800 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option>Proyecto</option>
                        <option>Consultoría</option>
                        <option>Donaciones</option>
                        <option>Acuerdo</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tipo de empresa</label>
                    <select class="w-full bg-gray-100 border border-gray-400 text-gray-800 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option>Organización Multilateral</option>
                        <option>Organismos Bilaterales</option>
                        <option>Instituciones gubernamentales</option>
                    </select>
                </div>
            </div>

            <!-- Dirección -->
            <div class="mt-4">
                <label class="block font-medium text-gray-700 mb-1">Dirección</label>
                <textarea rows="3" class="w-full bg-gray-100 border border-gray-400 text-gray-800 rounded-md px-3 py-2 overflow-y-auto resize-none focus:outline-none focus:ring-2 focus:ring-green-600" placeholder="Dirección completa de la empresa"></textarea>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2 mt-6">
                <button data-close-modal
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                <button class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800">Guardar</button>
            </div>
        </div>
    </div>


    <!-- Modal para editar tipo de empresa -->
<div data-modal-id="modalEditar"
     class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-800">
        <i class="fa-solid fa-pen mr-2 text-blue-700"></i>Editar el tipo de empresa
      </h3>
      <button data-close-modal aria-label="Cerrar modal">
        <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
      </button>
    </div>

    <!-- Subtítulo -->
    <p class="text-gray-600 mb-6">Puedes modificar la información del tipo de empresa</p>

    <div class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del tipo de empresa</label>
        <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800"
               placeholder="Nuevo nombre" />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción del tipo de empresa</label>
        <textarea class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800"
                  rows="3" placeholder="Nueva descripción"></textarea>
      </div>
      <div class="flex justify-end gap-2 mt-6">
        <button data-close-modal
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
          Cancelar
        </button>
        <button class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">
          Guardar cambios
        </button>
      </div>
    </div>
  </div>
</div>


    <!-- Modal para editar empresa -->
    <div data-modal-id="modalEditarEmpresa" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
            <!-- Encabezado -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fa-solid fa-pen mr-2 text-blue-700"></i>Editar empresa
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600 text-xl"></i>
                </button>
            </div>

            <!-- Subtítulo -->
            <p class="text-gray-600 mb-6">Puedes modificar la información de una empresa</p>

            <!-- Formulario -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm text-gray-700">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Abreviatura</label>
                    <input type="text" id="empresaAbreviatura" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" placeholder="Ej: INTEC">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de la empresa</label>
                    <input type="text" id="empresaNombre" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" placeholder="Ej: InnovaTech">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Código donante</label>
                    <input type="text" id="empresaCodigoDonante" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" placeholder="Ej: CD-1023">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select id="empresaEstado" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800">
                        <option value="">Seleccione un estado</option>
                        <option value="Activa">Activo</option>
                        <option value="Finalizada">Finalizada</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de cooperación</label>
                    <select id="empresaCooperacion" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800">
                        <option value="">Seleccione un tipo</option>
                        <option value="Multilateral">Multilateral</option>
                        <option value=""></option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de empresa</label>
                    <select id="empresaTipo" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800">
                        <option value="">Seleccione un tipo</option>
                        <option value="Organizacion Multilateral">Organizacion Multilateral</option>
                        <option value="Organismos Bilaterales">Organismos Bilaterales</option>
                        <option value="Instituciones gubernamentales">Instituciones gubernamentales</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de relación</label>
                    <select id="empresaRelacion" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800">
                        <option value="">Seleccione una relación</option>
                        <option value="Proyecto">Proyecto</option>
                        <option value="Consultoria">Consultoría</option>
                        <option value="Donaciones">Donaciones</option>
                        <option value="Acuerdo">Acuerdo</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                    <textarea id="empresaDireccion" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 resize-y overflow-y-auto" placeholder="Ej: Av. Central, San Salvador"></textarea>
                </div>

                <br>

                <!-- Botones -->
                <div class="flex justify-end gap-2 pt-4">
                    <button data-close-modal
                        class="min-w-[120px] px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                        Cancelar
                    </button>
                    <button class="min-w-[150px] px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800 transition">
                        Guardar cambios
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Confirmación de Eliminación en listado-->
    <div data-modal-id="modalConfirmarEliminar" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fa-solid fa-triangle-exclamation text-red-600 mr-2"></i>Confirmar eliminación
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                </button>
            </div>
            <p class="text-gray-700 mb-4">¿Estás seguro de eliminar esta empresa? <strong>Esta acción no se puede deshacer.</strong></p>
            <div class="flex justify-end gap-2">
                <button data-close-modal class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Eliminar</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmación de Eliminación en tipo-->
    <div data-modal-id="modalConfirmarEliminarr" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fa-solid fa-triangle-exclamation text-red-600 mr-2"></i>Confirmar eliminación
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                </button>
            </div>
            <p class="text-gray-700 mb-4">¿Estás seguro de eliminar este tipo de empresa? <strong>Esta acción no se puede deshacer.</strong></p>
            <div class="flex justify-end gap-2">
                <button data-close-modal class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Eliminar</button>
            </div>
        </div>
    </div>

    <!-- Modal Detalles de Empresa -->
    <div data-modal-id="modalDetallesEmpresa" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh]">
            <!-- Encabezado -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fa-solid fa-magnifying-glass text-blue-600 mr-2"></i>
                    Detalles de la empresa
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600 text-xl"></i>
                </button>
            </div>

            <!-- Subtítulo -->
            <p class="text-gray-600 mb-6">Consulta a detalle la información de una empresa</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm text-gray-700">
                <div>
                    <p class="font-semibold">Abreviatura:</p>
                    <div class="border rounded-md p-2 bg-gray-50">INTEC</div>
                </div>
                <div>
                    <p class="font-semibold">Nombre de la empresa:</p>
                    <div class="border rounded-md p-2 bg-gray-50">InnovaTech</div>
                </div>
                <div>
                    <p class="font-semibold">Código donante:</p>
                    <div class="border rounded-md p-2 bg-gray-50">CD-1023</div>
                </div>
                <div>
                    <p class="font-semibold">Estado:</p>
                    <div class="border rounded-md p-2 bg-gray-50">Activo</div>
                </div>
                <div>
                    <p class="font-semibold">Tipo de operación:</p>
                    <div class="border rounded-md p-2 bg-gray-50">Exportación</div>
                </div>
                <div>
                    <p class="font-semibold">Tipo de empresa:</p>
                    <div class="border rounded-md p-2 bg-gray-50">Tecnología</div>
                </div>
                <div>
                    <p class="font-semibold">Tipo de relación:</p>
                    <div class="border rounded-md p-2 bg-gray-50">Convenio estratégico</div>
                </div>
                <div>
                    <p class="font-semibold">Dirección:</p>
                    <div class="border rounded-md p-2 bg-gray-50">Av. Central, San Salvador</div>
                </div>
                <div>
                    <p class="font-semibold">Fecha de registro:</p>
                    <div class="border rounded-md p-2 bg-gray-50">2024-11-10</div>
                </div>
                <div>
                    <p class="font-semibold">Fecha de última modificación:</p>
                    <div class="border rounded-md p-2 bg-gray-50">2025-05-14</div>
                </div>
            </div>

            <!-- Botón cerrar -->
            <div class="flex justify-end mt-6">
                <button data-close-modal class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

</body>

</html>