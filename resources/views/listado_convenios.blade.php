<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de convenios</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/listado_convenios.js'])
    @endif
</head>

<body class="bg-background min-h-screen relative">

    <div class="container mx-auto px-6 xl:px-[5rem] py-10 min-h-screen">
        <!-- Encabezado -->
        <div class="flex items-start justify-between mb-10">
            <div class="space-y-2">
                <a href="{{ url("/") }}" class="text-blue-700 hover:underline text-sm text-decoration-none">
                    <i class="fa-solid fa-arrow-left mr-1 mb-4"></i> Regresar
                </a>
                <h1 class="text-3xl font-bold text-title">Listado de Convenios</h1>
                <p class="text-general">En este apartado puedes gestionar todos los convenios con empresas.</p>
            </div>
            <img src="{{ asset('img/logoFusalmoColored.png') }}" alt="Logo Fusalmo" class="h-12 lg:h-16">
        </div>

        <!-- Botón Agregar Convenio -->
        <div class="flex flex-wrap gap-4 mb-6">
            <button data-open-modal="modalAgregarConvenio"
                class="bg-green-700 text-background px-4 py-2 rounded-md shadow hover:bg-green-800 transition">
                <i class="fa-solid fa-plus mr-2"></i>Agregar convenio
            </button>
        </div>

        <!-- Botones de sección -->
        <div class="flex gap-4 mb-6">
            <button onclick="mostrarSeccion('conConvenios', this)" class="seccion-btn bg-title shadow-md px-6 py-3 rounded-xl text-white font-medium hover:bg-[#003b5c]  hover:text-white transition">
                Empresas con convenios
            </button>
            <button onclick="mostrarSeccion('sinConvenios', this)" class="seccion-btn bg-white shadow-md px-6 py-3 rounded-xl text-gray-700 font-medium hover:bg-[#003b5c]  hover:text-white transition">
                Empresas sin convenios
            </button>
        </div>

        <!-- Sección Empresas con Convenios -->
        <div id="conConvenios" class="bg-white rounded-xl shadow-md p-6 mb-10">
            <h2 class="text-xl font-semibold text-general mb-4">Empresas con convenios</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">N°</th>
                            <th class="px-4 py-2">Empresa</th>
                            <th class="px-4 py-2">Sede</th>
                            <th class="px-4 py-2">Situación actual</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-general">
                        @if ($withConvenios->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4 text-subtitle">No hay convenios registrados.</td>
                            </tr>
                        @else
                            @foreach ($withConvenios as $item)
                                <tr data-id="{{ $item->convenio_id }}">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $item->empresa->nombre_empresa }}</td>
                                    <td class="px-4 py-2">{{ $item->sede }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $item->estado }}</td>
                                    <td class="px-4 py-2 space-x-2 text-center">
                                        <button data-open-modal="modalDetalleConvenio"><i class="fa-solid fa-magnifying-glass text-general hover:text-botton"></i></button>
                                        <button data-open-modal="modalEditarConvenio"><i class="fa-solid fa-pen text-botton hover:text-title"></i></button>
                                        <button data-open-modal="modalSubirArchivo"><i class="fa-solid fa-cloud-arrow-up text-purple-600 hover:text-purple-800"></i></button>
                                        <button data-open-modal="modalConfirmarEliminar"><i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sección Empresas sin Convenios -->
        <div id="sinConvenios" class="bg-white rounded-xl shadow-md p-6 hidden">
            <h2 class="text-xl font-semibold text-general mb-4">Empresas sin convenios</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">N°</th>
                            <th class="px-4 py-2">Empresa</th>
                            <th class="px-4 py-2">Sede</th>
                            <th class="px-4 py-2">Situación actual</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-background text-general">
                        @if ($noConvenios->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4 text-subtitle">No hay empresas sin convenios.</td>
                            </tr>
                        @else
                            @foreach ($noConvenios as $item)
                                <tr data-id="{{ $item->convenio_id }}">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $item->empresa->nombre_empresa }}</td>
                                    <td class="px-4 py-2">{{ $item->sede }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $item->estado }}</td>
                                    <td class="px-4 py-2 space-x-2 text-center">
                                        <button data-open-modal="modalDetalleConvenio"><i class="fa-solid fa-magnifying-glass text-general hover:text-botton"></i></button>
                                        <button data-open-modal="modalEditarConvenio"><i class="fa-solid fa-pen text-botton hover:text-title"></i></button>
                                        <button data-open-modal="modalSubirArchivo"><i class="fa-solid fa-cloud-arrow-up text-purple-600 hover:text-purple-800"></i></button>
                                        <button data-open-modal="modalConfirmarEliminar"><i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Convenio -->
    <div data-modal-id="modalAgregarConvenio" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <form action="{{ route('convenios.store') }}" method="POST" id="formAgregarConvenio" class="bg-background rounded-xl shadow-lg w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto">
            @csrf
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
            <div  class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                <!-- Tipo de empresa -->
                <div>
                    <label class="block font-medium mb-1">Tipo de empresa</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general" id="tipo_empresa" name="tipo_empresa">
                        <option value="">Seleccionar</option>
                        @if ($tipos_empresa->isEmpty())
                            <option disabled class="font-thin">Sin Registros</option>
                        @else
                            @foreach ($tipos_empresa as $tipoEmpresa)
                                <option value="{{ $tipoEmpresa->tipo_empresa_id }}">{{ $tipoEmpresa->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Empresa -->
                <div>
                    <label class="block font-medium mb-1">Empresa</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general" disabled id="empresa" name="empresa">
                        <option value="">—</option>
                        @if($empresas_list->isEmpty())
                            <option disabled class="font-thin">Sin Registros</option>
                        @else
                            @foreach ($empresas_list as $empresa)
                                <option data-type="{{ $empresa->tipo_empresa_id }}" value="{{ $empresa->empresa_id }}" style="display: none;">{{ $empresa->nombre_empresa }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Sede -->
                <div>
                    <label class="block font-medium mb-1">Sede</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general" id="sede" name="sede">
                        <option value="">Seleccionar</option>
                        <option value="San Salvador">San Salvador</option>
                        <option value="Santa Ana">Santa Ana</option>
                        <option value="San Miguel">San Miguel</option>
                    </select>
                </div>

                <!-- Correo electrónico -->
                <div>
                    <label class="block font-medium mb-1">Correo electrónico</label>
                    <input type="email" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="correo@ejemplo.com" id="correo" name="correo">
                </div>

                <!-- Nombre de contacto -->
                <div>
                    <label class="block font-medium mb-1">Nombre de contacto</label>
                    <input type="text" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="Nombre completo" id="nombre_contacto" name="nombre_contacto">
                </div>

                <!-- Situación actual -->
                <div>
                    <label class="block font-medium mb-1">Situación actual</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general" id="situacion_actual" name="situacion_actual">
                        <option value="">Seleccionar</option>
                        <option value="activo">Activa</option>
                        <option value="finalizado">Finalizada</option>
                    </select>
                </div>

                <!-- Número de contacto -->
                <div>
                    <label class="block font-medium mb-1">Número de contacto</label>
                    <input type="tel" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="Ej: 1234-5678" data-mask="0000-0000" id="numero_contacto" name="numero_contacto">
                </div>

                <!-- Fecha de inicio -->
                <div>
                    <label class="block font-medium mb-1">Fecha de inicio</label>
                    <input type="date" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" id="fecha_inicio" name="fecha_inicio">
                </div>

                <!-- Tipo de convenio -->
                <div>
                    <label class="block font-medium mb-1">Tipo de convenio</label>
                    <select class="w-full border border-subtitle rounded-md px-3 py-2 text-general" id="tipo_convenio" name="tipo_convenio">
                        <option value="">Seleccionar</option>
                        <option value="Proyecto">Proyecto</option>
                        <option value="Consultoria">Consultoría</option>
                        <option value="Donaciones">Donaciones</option>
                        <option value="Acuerdo">Acuerdo</option>
                    </select>
                </div>

                <!-- Fecha de finalización -->
                <div>
                    <label class="block font-medium mb-1">Fecha de finalización</label>
                    <input type="date" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" id="fecha_finalizacion" name="fecha_finalizacion">
                </div>
            </div>
            <div class="mt-4">
                <label class="block font-medium mb-1 text-general">Convenio</label>
                <textarea rows="5" class="w-full border border-subtitle rounded-md px-3 py-2 text-general resize-y overflow-y-auto" placeholder="Detalles del convenio..." id="detalles_convenio" name="detalles_convenio"></textarea>
            </div>

            <!-- Checkbox -->
            <div class="mt-4 flex items-start gap-2">
                <input type="checkbox" id="documentacion" name="documentacion" class="mt-1" value="1">
                <label for="documentacion" class="text-sm text-general">Este convenio está respaldado con documentación.</label>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2 mt-6">
                <div data-close-modal
                    class="text-center cursor-pointer min-w-[120px] px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Cancelar
            </div>
                <button  class="cursor-pointer min-w-[120px] px-4 py-2 bg-botton text-background rounded-md hover:bg-title transition" id="btnAgregar">
                    Agregar
                </button>
            </div>
        </form>
    </div>

    <!-- Modal Detalles Convenio -->
    <div data-modal-id="modalDetalleConvenio" class="modal-details transit fixed inset-0 bg-black/60 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
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
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="abreviatura"></div>
                    </div>
                    <div>
                        <p class="font-semibold">Nombre de la empresa:</p>
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="nombre_empresa"></div>
                    </div>
                    <div>
                        <p class="font-semibold">Código donante:</p>
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="codigo_donante"></div>
                    </div>
                    <div>
                        <p class="font-semibold">Estado:</p>
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle capitalize" id="estado_empre"></div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de operación:</p>
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="tipo_operacion"></div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de empresa:</p>
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="tipo_empresa_det"></div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de relación:</p>
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="tipo_relacion"></div>
                    </div>
                    <div>
                        <p class="font-semibold">Dirección:</p>
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="direccion_det"></div>
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="space-y-4 pl-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold">Sede:</p>
                            <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="sede_det"></div>
                        </div>

                        <div>
                            <p class="font-semibold">Correo electrónico:</p>
                            <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="correo_det"></div>
                        </div>

                        <div>
                            <p class="font-semibold">Nombre de contacto:</p>
                            <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="nombre_contacto_det"></div>
                        </div>

                        <div>
                            <p class="font-semibold">Situación actual:</p>
                            <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="situacion_actual_det"></div>
                        </div>

                        <div>
                            <p class="font-semibold">Número de contacto:</p>
                            <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="numero_contacto_det"></div>
                        </div>

                        <div>
                            <p class="font-semibold">Fecha de inicio:</p>
                            <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="fecha_inicio_det"></div>
                        </div>

                        <div>
                            <p class="font-semibold">Tipo de convenio:</p>
                            <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="tipo_convenio_det">Consultoría</div>
                        </div>

                        <div>
                            <p class="font-semibold">Fecha de finalización:</p>
                            <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="fecha_fin_det">2025-12-20</div>
                        </div>
                    </div>


                    <!-- Convenio -->
                    <div>
                        <p class="font-semibold">Convenio:</p>
                        <div class="rounded-md p-2 bg-gray-50 text-subtitle" id="convenio_det">
                            Consultoría para desarrollo tecnológico en sector educativo.
                        </div>
                    </div>


                    <!-- Indicadores -->
                    <div class="mt-2 space-y-2 text-sm text-general">
                        <p style="display: none;" id="respaldo_doc" class="text-lime-600 font-bold"><i class="fa-solid fa-file-shield mr-2"></i>Este convenio está respaldado con documentación.</p>
                        <p style="display: none;" id="respaldo_doc_no" class="text-red-600 font-bold"><i class="fa-solid fa-file-excel mr-2"></i>Este convenio no está respaldado con documentación.</p>
                    </div>

                    <!-- Botón descargar -->
                    <div id="btnDescargar" class="mt-2" style="display: none;" >
                        <a class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            <i class="fa-solid fa-download mr-2"></i>Descargar archivo
                        </a>
                    </div>

                    <!-- Fechas -->
                    <div class="mt-4 flex flex-col sm:flex-row gap-4">
                        <div class="w-full">
                            <label class="block font-medium mb-1">Fecha de registro</label>
                            <div id="fecha_registro_det" class="w-full rounded-md px-3 py-2 text-general" ></div>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium mb-1">Fecha de última modificación</label>
                            <div  id="fecha_modificacion_det" class="w-full rounded-md px-3 py-2 text-general"></div>
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
    <div data-modal-id="modalEditarConvenio" class="modal-edit transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <form id="formActualizarConvenio" method="POST" action="{{ route('convenios.update') }}" class="bg-background rounded-xl shadow-lg w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-general">
                    <i class="fa-solid fa-pen text-blue-600 hover:text-blue-800 mr-2"></i>Editar información del convenio
                </h3>
                <button data-close-modal>
                    <i class="fa-solid fa-xmark text-subtitle hover:text-red-600 text-lg"></i>
                </button>
            </div>
            <!-- Subtítulo -->
            <p class="text-subtitle mb-6">Puedes modificar la información del convenio</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                @csrf
                <input type="hidden" name="convenioId" id="convenioId">

                <!-- Tipo de empresa -->
                <div>
                    <label class="block font-medium mb-1">Tipo de empresa</label>
                    <select name="tipo_empresa" id="edit_tipo_empresa" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        @if ($tipos_empresa->isEmpty())
                            <option disabled class="font-thin">Sin Registros</option>
                        @else
                            @foreach ($tipos_empresa as $tipoEmpresa)
                                <option value="{{ $tipoEmpresa->tipo_empresa_id }}">{{ $tipoEmpresa->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Empresa -->
                <div>
                    <label class="block font-medium mb-1">Empresa</label>
                    <select name="empresa" id="edit_empresa" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        @if ($empresas_list->isEmpty())
                            <option disabled class="font-thin">Sin Registros</option>
                        @else
                            @foreach ($empresas_list as $empresa)
                                <option data-type="{{ $empresa->tipo_empresa_id }}" value="{{ $empresa->empresa_id }}" style="display: none;">{{ $empresa->nombre_empresa }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Sede -->
                <div>
                    <label class="block font-medium mb-1">Sede</label>
                    <select name="sede" id="edit_sede" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option>San Salvador</option>
                        <option>Santa Ana</option>
                        <option>San Miguel</option>
                    </select>
                </div>

                <!-- Correo electrónico -->
                <div>
                    <label class="block font-medium mb-1">Correo electrónico</label>
                    <input name="correo" id="edit_correo" type="email" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="correo@ejemplo.com">
                </div>

                <!-- Nombre de contacto -->
                <div>
                    <label class="block font-medium mb-1">Nombre de contacto</label>
                    <input name="nombre_contacto" id="edit_nombre_contacto" type="text" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" placeholder="Nombre completo">
                </div>

                <!-- Situación actual -->
                <div>
                    <label class="block font-medium mb-1">Situación actual</label>
                    <select name="situacion_actual" id="edit_situacion_actual" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option value="activo">Activa</option>
                        <option value="finalizado">Finalizada</option>
                    </select>
                </div>

                <!-- Número de contacto -->
                <div>
                    <label class="block font-medium mb-1">Número de contacto</label>
                    <input name="numero_contacto" id="edit_numero_contacto" type="tel" class="w-full border border-subtitle rounded-md px-3 py-2 text-general" data-mask="0000-0000" placeholder="Ej: 1234-5678">
                </div>

                <!-- Fecha de inicio -->
                <div>
                    <label class="block font-medium mb-1">Fecha de inicio</label>
                    <input name="fecha_inicio" id="edit_fecha_inicio" type="date" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                </div>

                <!-- Tipo de convenio -->
                <div>
                    <label class="block font-medium mb-1">Tipo de convenio</label>
                    <select name="tipo_convenio" id="edit_tipo_convenio" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                        <option value="">Seleccionar</option>
                        <option value="Proyecto">Proyecto</option>
                        <option value="Consultoria">Consultoría</option>
                        <option value="Donaciones">Donaciones</option>
                        <option value="Acuerdo">Acuerdo</option>
                    </select>
                </div>

                <!-- Fecha de finalización -->
                <div>
                    <label class="block font-medium mb-1">Fecha de finalización</label>
                    <input name="fecha_finalizacion" id="edit_fecha_finalizacion" type="date" class="w-full border border-subtitle rounded-md px-3 py-2 text-general">
                </div>
            </div>
            <div class="mt-4">
                <label class="block font-medium mb-1 text-general">Convenio</label>
                <textarea name="detalles_convenio" id="edit_convenio" rows="5" class="w-full border border-subtitle rounded-md px-3 py-2 text-general resize-y overflow-y-auto" placeholder="Detalles del convenio..."></textarea>
            </div>

            <!-- Checkbox -->
            <div class="mt-4 flex items-start gap-2">
                <input name="documentacion" type="checkbox" id="edit_documentacion" class="mt-1">
                <label id="edit_documentacion" for="edit_documentacion" class="text-sm text-general">Este convenio está respaldado con documentación.</label>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2 mt-6">
                <div data-close-modal
                    class="cursor-pointer text-center min-w-[120px] px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Cancelar
                </div>
                <button id="btnActualizar" class="cursor-pointer min-w-[120px] px-4 py-2 bg-botton text-background rounded-md hover:bg-title transition">
                    Actualizar
                </button>
            </div>
        </form>
    </div>

    <!-- Modal Subir Archivo -->
<div data-modal-id="modalSubirArchivo" class="modal-upload transit fixed inset-0 bg-black/60 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
  <form id="formSubirArchivo" action="{{ route('convenios.upload') }}" method="POST" enctype="multipart/form-data" class="bg-background rounded-xl shadow-lg w-[90vw] max-w-xl p-6 max-h-[90vh] overflow-y-auto">
    @csrf
    <input type="hidden" name="convenioId" id="convenioIdSubirArchivo">
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
    <!-- Área para subir archivo -->
    <label for="file-convenio" class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md bg-gray-50 p-6 cursor-pointer hover:bg-gray-100 transition">
      <i class="fa-solid fa-upload text-2xl text-gray-500 mb-2"></i>
      <p class="text-sm text-gray-600" id="file-convenio-label">Sube tu archivo aquí</p>
      <input type="file" id="file-convenio" name="documentacion" class="hidden" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xlsx,.xls" />
    </label>

    <div class="flex justify-end gap-2 mt-6">
      <div data-close-modal
                    class="cursor-pointer text-center min-w-[120px] px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Cancelar
    </div>
      <button id="btnGuardarArchivo" class="cursor-pointer min-w-[150px] px-4 py-2 bg-botton text-white rounded-md hover:bg-title transition">
        Guardar
      </button>
    </div>
    </form>
</div>

<!-- Modal Confirmación de Eliminación de convenio -->
    <div data-modal-id="modalConfirmarEliminar" class="modal-delete transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
            opacity-0 pointer-events-none transition-opacity duration-300">
        <form action="{{ route('convenios.delete') }}" method="POST" class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            @csrf
            <input type="hidden" name="convenioId" id="convenioIdEliminar">

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
                <div data-close-modal class="cursor-pointer text-center bg-gray-200 text-general px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</div>
                <button class="cursor-pointer bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Eliminar</button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <script type="module">
            iziToast.success({
                title: '¡Éxito!',
                message: "{{ session('success') }}",
                icon: 'fa-solid fa-check',
                progressBar: false,
                layout: 2,
            });
        </script>
    @endif

</body>

</html>
