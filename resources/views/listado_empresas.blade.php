<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de empresas</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a2d9a66d2a.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <h1 class="text-3xl font-bold text-title">Listado de Empresas</h1>
                <p class="text-general">En este apartado puedes gestionar todas las empresas.</p>
            </div>
            <img src="{{ asset('img/logoFusalmoColored.png') }}" alt="Logo Fusalmo" class="h-12 lg:h-16">
        </div>

        <!-- Botones agregar -->
        <div class="flex flex-wrap gap-4 mb-6">
            <button data-open-modal="modalAgregarEmpresa"
                class="bg-green-700 text-white px-4 py-2 rounded-md shadow hover:bg-green-800 transition">
                <i class="fa-solid fa-plus mr-2"></i>Agregar empresa
            </button>
        </div>

        <!-- Botones sección -->
        <div class="flex gap-4 mb-6">
            <a href="{{ route('tipos-empresa.index') }}"
                class="seccion-btn shadow-md px-6 py-3 rounded-xl text-gray-700 font-medium hover:bg-[#003b5c] hover:text-white transition">
                Tipo de empresa
            </a>
            <a href="{{ route('empresas.index') }}"
                class="seccion-btn bg-title text-white shadow-md px-6 py-3 rounded-xl text-gray-700 font-medium hover:bg-[#003b5c] hover:text-white transition">
                Listado de empresas
            </a>
        </div>

        <!-- Tabla de empresas -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-10">
            <h2 class="text-xl font-semibold text-general mb-4">Listado de empresas</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">N°</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Abreviatura</th>
                            <th class="px-4 py-2">Código donante</th>
                            <th class="px-4 py-2">Tipo</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @if ($empresasList->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fa-regular fa-folder-open mr-1"></i>
                                    No se encontraron empresas registradas
                                </td>
                            </tr>
                        @else
                            @foreach ($empresasList as $empresa)
                                <tr>
                                    <td class="px-4 py-2">{{ $empresa->empresa_id }}</td>
                                    <td class="px-4 py-2">{{ $empresa->nombre_empresa }}</td>
                                    <td class="px-4 py-2">{{ $empresa->abreviatura_empresa }}</td>
                                    <td class="px-4 py-2">{{ $empresa->codigo_donante ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $empresa->tipoEmpresa->nombre ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs
                                                                                    {{ $empresa->estado == 'Activa' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $empresa->estado }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 space-x-2 text-center">
                                        <!-- Botón Detalles -->
                                        <button data-open-modal="modalDetallesEmpresa-{{ $empresa->empresa_id }}">
                                            <i class="fa-solid fa-magnifying-glass text-gray-700 hover:text-blue-600"></i>
                                        </button>

                                        <!-- Botón Editar -->
                                        <form action="{{ route('empresas.index') }}" method="GET" style="display: inline;">
                                            <input type="hidden" name="editar" value="{{ $empresa->empresa_id }}">
                                            <button type="submit">
                                                <i class="fa-solid fa-pen text-blue-600 hover:text-blue-800"></i>
                                            </button>
                                        </form>

                                        <!-- Botón Eliminar -->
                                        <button data-open-modal="modalEliminarEmpresa-{{ $empresa->empresa_id }}">
                                            <i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
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

            <!-- Formulario -->
            <form action="{{ route('empresas.store') }}" method="POST">
                @csrf
                <p class="text-gray-600 mb-6">Proporciona detalles sobre la empresa a registrar</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Abreviatura *</label>
                        <input name="abreviatura_empresa" type="text" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600"
                            placeholder="Ej: INTEC">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Nombre *</label>
                        <input name="nombre_empresa" type="text" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600"
                            placeholder="Ej: InnovaTech">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Código donante</label>
                        <input name="codigo_donante" type="text" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600"
                            placeholder="Ej: CD-1023">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tipo de cooperación</label>
                        <input name="tipo_cooperacion" type="text" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600"
                            placeholder="Ej: Multilateral">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tipo de relación</label>
                        <select name="tipo_relacion" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600">
                            <option value="">Seleccione...</option>
                            <option value="Proyecto">Proyecto</option>
                            <option value="Consultoría">Consultoría</option>
                            <option value="Donaciones">Donaciones</option>
                            <option value="Acuerdo">Acuerdo</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Estado *</label>
                        <select name="estado" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600">
                            <option value="activo">Activa</option>
                            <option value="inactivo">Finalizada</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tipo de empresa *</label>
                        <select name="tipo_empresa_id" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600">
                            <option value="">Seleccione...</option>
                            @foreach($tipoEmpresas as $tipo)
                                <option value="{{ $tipo->tipo_empresa_id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Dirección</label>
                        <textarea name="direccion" rows="3" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 overflow-y-auto resize-none focus:outline-none focus:ring-2 focus:ring-green-600"
                            placeholder="Dirección completa de la empresa"></textarea>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-2 mt-6">
                    <button data-close-modal type="button"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                    <button type="submit"
                        class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para editar empresa -->
    @if(isset($editarEmpresa))
        <div
            class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
                            {{ isset($editarEmpresa) ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none' }} transition-opacity duration-300">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6">
                <form action="{{ route('empresas.update', $editarEmpresa->empresa_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <i class="fa-solid fa-pen mr-2 text-blue-700"></i>Editar empresa
                        </h3>
                        <a href="{{ route('empresas.index') }}">
                            <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                        </a>
                    </div>

                    <p class="text-gray-600 mb-6">Puedes modificar la información de la empresa</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Abreviatura *</label>
                            <input name="abreviatura_empresa" type="text" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800"
                                value="{{ old('abreviatura_empresa', $editarEmpresa->abreviatura_empresa) }}">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Nombre *</label>
                            <input name="nombre_empresa" type="text" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800"
                                value="{{ old('nombre_empresa', $editarEmpresa->nombre_empresa) }}">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Código donante</label>
                            <input name="codigo_donante" type="text" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800"
                                value="{{ old('codigo_donante', $editarEmpresa->codigo_donante) }}">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Tipo de cooperación</label>
                            <input name="tipo_cooperacion" type="text" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800"
                                value="{{ old('tipo_cooperacion', $editarEmpresa->tipo_cooperacion) }}">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Tipo de relación</label>
                            <select name="tipo_relacion"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" required>
                                <option value="">Seleccione...</option>
                                <option value="Proyecto" {{ old('tipo_relacion', $editarEmpresa->tipo_relacion) == 'Proyecto' ? 'selected' : '' }}>Proyecto</option>
                                <option value="Consultoría" {{ old('tipo_relacion', $editarEmpresa->tipo_relacion) == 'Consultoría' ? 'selected' : '' }}>Consultoría</option>
                                <option value="Donaciones" {{ old('tipo_relacion', $editarEmpresa->tipo_relacion) == 'Donaciones' ? 'selected' : '' }}>Donaciones</option>
                                <option value="Acuerdo" {{ old('tipo_relacion', $editarEmpresa->tipo_relacion) == 'Acuerdo' ? 'selected' : '' }}>Acuerdo</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Estado *</label>
                            <select name="estado" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800">
                                <option value="activo" {{ old('estado', $editarEmpresa->getOriginal('estado')) == 'activo' ? 'selected' : '' }}>Activa</option>
                                <option value="inactivo" {{ old('estado', $editarEmpresa->getOriginal('estado')) == 'inactivo' ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Tipo de empresa *</label>
                            <select name="tipo_empresa_id" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800">
                                <option value="">Seleccione...</option>
                                @foreach($tipoEmpresas as $tipo)
                                    <option value="{{ $tipo->tipo_empresa_id }}" {{ old('tipo_empresa_id', $editarEmpresa->tipo_empresa_id) == $tipo->tipo_empresa_id ? 'selected' : '' }}>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Dirección</label>
                            <textarea name="direccion" rows="3" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800 resize-y overflow-y-auto">{{ old('direccion', $editarEmpresa->direccion) }}</textarea>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('empresas.index') }}"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Modales de detalles y eliminación para cada empresa -->
    @foreach ($empresasList as $empresa)
        <!-- Modal Detalles de Empresa -->
        <div data-modal-id="modalDetallesEmpresa-{{ $empresa->empresa_id }}" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
                                    opacity-0 pointer-events-none transition-opacity duration-300">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fa-solid fa-magnifying-glass text-blue-600 mr-2"></i>
                        Detalles de la empresa
                    </h3>
                    <button data-close-modal>
                        <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600 text-xl"></i>
                    </button>
                </div>

                <p class="text-gray-600 mb-6">Información detallada de la empresa</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm text-gray-700">
                    <div>
                        <p class="font-semibold">Abreviatura:</p>
                        <div class="rounded-md p-2 bg-gray-50">{{ $empresa->abreviatura_empresa }}</div>
                    </div>
                    <div>
                        <p class="font-semibold">Nombre:</p>
                        <div class="rounded-md p-2 bg-gray-50">{{ $empresa->nombre_empresa }}</div>
                    </div>
                    <div>
                        <p class="font-semibold">Código donante:</p>
                        <div class="rounded-md p-2 bg-gray-50">{{ $empresa->codigo_donante ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <p class="font-semibold">Estado:</p>
                        <div class="rounded-md p-2 bg-gray-50">{{ $empresa->estado }}</div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de cooperación:</p>
                        <div class="rounded-md p-2 bg-gray-50">{{ $empresa->tipo_cooperacion ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de empresa:</p>
                        <div class="rounded-md p-2 bg-gray-50">{{ $empresa->tipoEmpresa->nombre ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <p class="font-semibold">Tipo de relación:</p>
                        <div class="rounded-md p-2 bg-gray-50">{{ $empresa->tipo_relacion ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <p class="font-semibold">Dirección:</p>
                        <div class="rounded-md p-2 bg-gray-50">{{ $empresa->direccion ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button data-close-modal class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Confirmación de Eliminación -->
        <div data-modal-id="modalEliminarEmpresa-{{ $empresa->empresa_id }}" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
                                    opacity-0 pointer-events-none transition-opacity duration-300">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fa-solid fa-triangle-exclamation text-red-600 mr-2"></i>Confirmar deshabilitación
                    </h3>
                    <button data-close-modal>
                        <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                    </button>
                </div>
                <p class="text-gray-700 mb-4">¿Estás seguro de deshabilitar la empresa
                    <strong>{{ $empresa->nombre_empresa }}</strong>? <br>Esta acción no se puede deshacer.
                </p>
                <div class="flex justify-end gap-2">
                    <button data-close-modal
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                    <form action="{{ route('empresas.destroy', $empresa->empresa_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Deshabilitar</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</body>

</html>
