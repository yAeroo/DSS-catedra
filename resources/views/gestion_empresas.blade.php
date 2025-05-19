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

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/gestion_empresas.js'])
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
                <h1 class="text-3xl font-bold text-title">Tipos de Empresas</h1>
                <p class="text-general">En este apartado puedes gestionar todos los tipos de empresa.</p>
            </div>
            <img src="{{ asset('img/logoFusalmoColored.png') }}" alt="Logo Fusalmo" class="h-12 lg:h-16">
        </div>

        <!-- Botones agregar -->
        <div class="flex flex-wrap gap-4 mb-6">
            <button data-open-modal="modalAgregarTipo"
                class="bg-green-700 text-white px-4 py-2 rounded-md shadow hover:bg-green-800 transition">
                <i class="fa-solid fa-plus mr-2"></i>Agregar tipo de empresa
            </button>
        </div>
        
        <!-- Botones sección -->
        <div class="flex gap-4 mb-6">
            <a href="{{ route('tipos-empresa.index') }}"
                class="seccion-btn bg-title text-white shadow-md px-6 py-3 rounded-xl text-gray-700 font-medium hover:bg-[#003b5c] hover:text-white transition">
                Tipo de empresa
            </a>
            <a href="{{ route('empresas.index') }}"
                class="seccion-btn shadow-md px-6 py-3 rounded-xl text-gray-700 font-medium hover:bg-[#003b5c] hover:text-white transition">
                Listado de empresas
            </a>
        </div>

        <!-- Sección Tipo de empresa -->
        <div id="tipoEmpresa" class="bg-white rounded-xl shadow-md p-6 mb-10">
            <h2 class="text-xl font-semibold text-general mb-4">Tipo de empresa</h2>
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
                    <tbody class="divide-y divide-gray-200  text-gray-700">
                        @if ($tipoEmpresasList->isEmpty()) <!-- Verificando si esta vacío -->
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fa-regular fa-folder-open mr-1"></i>
                                    No se encontraron Tipos de Empresa
                                </td>
                            </tr>
                        @else
                            <!--{{ $i = 0 }}  Iniciando el contador -->
                            @foreach ($tipoEmpresasList->where('habilitada', 1) as $tipoEmpresa)
                                <!-- Mapeo de Tipo de Empresas -->
                                <tr>
                                    <td class="px-4 py-2">{{ $tipoEmpresa->tipo_empresa_id }}</td>
                                    <td class="px-4 py-2">{{ $tipoEmpresa->nombre }}</td>
                                    <td class="px-4 py-2">{{ $tipoEmpresa->descripcion }}</td>
                                    <td class="px-4 py-2 space-x-2 text-center">

                                        <!-- Botón Editar -->
                                        <form action="{{ route('tipos-empresa.index') }}" method="GET" style="display: inline;">
                                            <input type="hidden" name="editar" value="{{ $tipoEmpresa->tipo_empresa_id }}">
                                            <button type="submit">
                                                <i class="fa-solid fa-pen text-blue-600 hover:text-blue-800"></i>
                                            </button>
                                        </form>

                                        <!-- Botón Eliminar (abre modal de confirmación) -->
                                        <button data-open-modal="modalEliminarTipoEmpresa-{{ $tipoEmpresa->tipo_empresa_id }}">
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


    <!-- Modales CUD -->

    <!-- Modal Agregar Tipo de Empresa -->
    <div data-modal-id="modalAgregarTipo" class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
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

            <form action="{{ route('tipos-empresa.store') }}" method="POST">
                @csrf

                <p class="text-gray-600 mb-6">Proporciona información sobre el tipo de empresa a registrar</p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del tipo de empresa</label>
                        <input name="nombre" type="text" id="inputNombreTipo"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" id="inputDescripcionTipo"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" rows="3"
                            required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button data-close-modal
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para editar tipo de empresa -->
    <div
        class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50
    {{ isset($editarTipoEmpresa) ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none' }} transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <form action="{{ route('tipos-empresa.update', $editarTipoEmpresa->tipo_empresa_id ?? 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fa-solid fa-pen mr-2 text-blue-700"></i>Editar el tipo de empresa
                    </h3>
                    <a href="{{ route('tipos-empresa.index') }}">
                        <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                    </a>
                </div>

                <p class="text-gray-600 mb-6">Puedes modificar la información del tipo de empresa</p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del tipo de empresa</label>
                        <input type="text" name="nombre"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800"
                            placeholder="Nuevo nombre" value="{{ old('nombre', $editarTipoEmpresa->nombre ?? '') }}"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción del tipo de
                            empresa</label>
                        <textarea name="descripcion"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-gray-800" rows="3"
                            placeholder="Nueva descripción">{{ old('descripcion', $editarTipoEmpresa->descripcion ?? '') }}</textarea>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('tipos-empresa.index') }}"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">
                            Guardar cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para deshabilitar tipo de empresa-->
    @foreach ($tipoEmpresasList as $tipoEmpresa)
        <div data-modal-id="modalEliminarTipoEmpresa-{{ $tipoEmpresa->tipo_empresa_id }}"
            class="transit fixed inset-0 bg-black/60 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fa-solid fa-triangle-exclamation text-red-600 mr-2"></i>Confirmar deshabilitación
                    </h3>
                    <button data-close-modal>
                        <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                    </button>
                </div>
                <p class="text-gray-700 mb-4">¿Estás seguro de deshabilitar este tipo de empresa? <strong>No se mostrará en
                        los listados.</strong></p>
                <div class="flex justify-end gap-2">
                    <button data-close-modal
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                    <form action="{{ route('tipos-empresa.destroy', $tipoEmpresa->tipo_empresa_id) }}" method="POST">
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