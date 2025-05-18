<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de empresas y convenios</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto px-6 xl:px-[5rem] py-10 min-h-screen">
        <!-- Encabezado -->
        <div class="flex items-start justify-between mb-10">
            <div>
                <h1 class="text-3xl font-bold text-title">Gestión de empresas y convenios</h1>
                <p class="text-general">Accede al panel de control para gestionar tus empresas y convenios.</p>
            </div>
            <img src="{{ asset('img/logoFusalmoColored.png') }}" alt="Logo Fusalmo" class="h-12 lg:h-16">
        </div>

        <!-- Cards -->
        <div class="flex items-center justify-center min-h-[calc(100vh-20rem)]">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-md p-8 flex flex-col items-center">
                    <i class="fa-solid fa-building text-6xl text-title mb-5"></i>
                    <h2 class="text-xl font-semibold text-gray-800">Administrar empresas</h2>
                    <p class="text-gray-600 text-center mt-2">Gestiona tipos de empresa o agrega nuevas empresas.</p>
                    <a href="{{ url('gestion_empresas') }}">
                        <button
                            class="bg-title rounded-md px-4 py-2 mt-4 hover:bg-blue-950 outline-current">Acceder</button>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-md p-8 flex flex-col items-center">
                    <i class="fa-solid fa-file-lines text-6xl text-title mb-5"></i>
                    <h2 class="text-xl font-semibold text-gray-800">Administrar convenios</h2>
                    <p class="text-gray-600 text-center mt-2">Echa un vistazo a los convenios actuales o agrega nuevos.
                    </p>
                    <a href="{{ url('listado_convenios') }}">
                        <button
                            class="bg-title rounded-md px-4 py-2 mt-4 hover:bg-blue-950 outline-current">Acceder</button>
                    </a>

                </div>
            </div>
        </div>
    </div>

</body>

</html>