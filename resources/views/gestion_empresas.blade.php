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

<body class="bg-gray-100 min-h-screen relative">

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
            <button onclick="document.getElementById('modalAgregarTipo').classList.remove('hidden')"
                class="bg-blue-700 text-white px-4 py-2 rounded-md shadow hover:bg-blue-800 transition">
                <i class="fa-solid fa-plus mr-2"></i>Agregar tipo de empresa
            </button>
            <button onclick="document.getElementById('modalAgregarEmpresa').classList.remove('hidden')"
                class="bg-green-700 text-white px-4 py-2 rounded-md shadow hover:bg-green-800 transition">
                <i class="fa-solid fa-plus mr-2"></i>Agregar empresa
            </button>
        </div>


        <!-- Barra búsqueda -->
        <div class="mb-6 max-w-sm">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input
                    type="text"
                    id="busqueda"
                    placeholder="Buscar..."
                    class="pl-10 pr-4 py-2 w-full bg-gray-100 text-gray-800 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500">
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
                                <button onclick="document.getElementById('modalEditar').classList.remove('hidden')">
                                    <i class="fa-solid fa-pen text-blue-600 hover:text-blue-800"></i>
                                </button>
                                <button>
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
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Tipo</th>
                            <th class="px-4 py-2">Ubicación</th>
                            <th class="px-4 py-2">Contacto</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <!-- Ejemplo de prueba -->
                    <tbody class="divide-y divide-gray-200  text-gray-700">
                        <tr>
                            <td class="px-4 py-2">InnovaTech</td>
                            <td class="px-4 py-2">Tecnología</td>
                            <td class="px-4 py-2">San Salvador</td>
                            <td class="px-4 py-2">innova@tech.com</td>
                            <td class="px-4 py-2 space-x-2">
                                <button onclick="document.getElementById('modalEditar').classList.remove('hidden')">
                                    <i class="fa-solid fa-pen text-blue-600 hover:text-blue-800"></i>
                                </button>
                                <button>
                                    <i class="fa-solid fa-trash text-red-600 hover:text-red-800"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Tipo de Empresa -->
    <div id="modalAgregarTipo" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fa-solid fa-plus mr-2 text-blue-700"></i>Agregar tipo de empresa
                </h3>
                <button onclick="document.getElementById('modalAgregarTipo').classList.add('hidden')">
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">N°</label>
                    <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="ID automático o manual">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del tipo de empresa</label>
                    <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Nombre del tipo">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea class="w-full border border-gray-300 rounded-md px-3 py-2" rows="3" placeholder="Descripción del tipo"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button onclick="document.getElementById('modalAgregarTipo').classList.add('hidden')"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                    <button class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Empresa -->
    <div id="modalAgregarEmpresa" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fa-solid fa-plus mr-2 text-green-700"></i>Agregar empresa
                </h3>
                <button onclick="document.getElementById('modalAgregarEmpresa').classList.add('hidden')">
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Nombre de la empresa">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                    <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Tipo de empresa">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación</label>
                    <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Ubicación">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contacto</label>
                    <input type="email" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Correo electrónico o teléfono">
                </div>
                <div class="flex justify-end gap-2">
                    <button onclick="document.getElementById('modalAgregarEmpresa').classList.add('hidden')"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancelar</button>
                    <button class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar tipo de empresa -->
    <div id="modalEditar"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fa-solid fa-pen mr-2 text-blue-700"></i>Editar el tipo de empresa
                </h3>
                <button onclick="document.getElementById('modalEditar').classList.add('hidden')">
                    <i class="fa-solid fa-xmark text-gray-600 hover:text-red-600"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del tipo de empresa</label>
                    <input type="text" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Nuevo nombre">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción del tipo de empresa</label>
                    <textarea class="w-full border border-gray-300 rounded-md px-3 py-2" rows="3" placeholder="Nueva descripción"></textarea>
                </div>
                <div class="flex justify-end">
                    <button
                        class="bg-blue-700 text-white px-4 py-2 rounded-md shadow hover:bg-blue-800 transition">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>