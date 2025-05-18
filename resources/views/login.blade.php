<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de empresas y convenios</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

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
                <h1 class="text-3xl font-bold text-title">Archivo Digital de Asociados y Convenios</h1>
                <p class="text-general">Sistema para registrar todos los acuerdos entre empresas.</p>
            </div>
            <img src="{{ asset('img/logoFusalmoColored.png') }}" alt="Logo Fusalmo" class="h-12 lg:h-16">
        </div>


        <div class="flex items-center justify-center min-h-[calc(100vh-20rem)]">
            <div class="bg-white rounded-xl shadow-md p-8 flex flex-col items-center w-lg">
                <i class="fa-solid fa-user-lock text-6xl text-title mb-5"></i>
                <h2 class="text-xl font-semibold text-gray-800">Iniciar Sesión</h2>



                <form method="POST" action="{{ route('login.auth') }}" class="w-full mt-4">

                    @if (session('error'))
                        <div role="alert" id="alert" class="alert alert-error alert-soft">
                            <i class="fa-solid fa-circle-exclamation text-lg"></i><span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @csrf
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Nombre</legend>
                        <input type="text" class="input w-full" name="name" id="name" value="{{ old('name') }}" />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Contraseña</legend>
                        <input type="password" class="input w-full" name="password" id="password" />
                    </fieldset>

                    <div class="flex justify-center items-center mt-5">
                        <button type="submit" class="btn btn-success">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('error'))
        <script>
            setTimeout(() => {
                $('#alert').fadeOut('slow');
            }, 5000);
        </script>

    @endif

</body>

</html>
