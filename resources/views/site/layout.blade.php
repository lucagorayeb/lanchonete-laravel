<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MECDONIN | @yield('titulo')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Inter:wght@400..900&display=swap" rel="stylesheet">
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

    @yield('estilos')
</head>
<body>

    @hasSection('header')
        @yield('header')
    @else
        <header class="logo-container">
            <div class="logo-box">
                <img src="{{ asset('img/figma/radape/logo-mecdonin.png') }}" alt="Logo Lanchonete" class="logo-img">
            </div>
            <h1 style="color: var(--color-primary); font-weight: 800; font-style: italic;">MECDONIN</h1>
            <p class="small" style="font-weight: bold; letter-spacing: 1px;">MISTURA PERFEITA.</p>
        </header>
    @endif

    <main>
        @yield('conteudo')
    </main>

    @hasSection('footer')
        @yield('footer')
    @else
        <footer style="text-align: center; padding: 20px;">
            <p>&copy; {{ date('Y') }} - MECDONIN</p>
        </footer>
    @endif

    @yield('scripts')
</body>
</html>
