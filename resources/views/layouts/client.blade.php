<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <header class="header">
        <div class="container">
            <a class="my-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>

            <nav>
                <ul class="menu">
                    @auth
                        <li><a href="{{ route('posts.create') }}">Cadastrar Notícia</a></li>
                        <li><a href="{{ route('posts.index') }}">Exibir Notícias</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Entrar</a></li>
                        <li><a href="{{ route('register') }}">Regista-te</a></li>
                    @endauth
                </ul>

                <form action="" method="get" class="bg-white rounded">
                <input type="text" name="query"  
                value="{{ request('query') ?? '' }}"
                class="border-0 p-2 px-3 bg-white rounded" 
                style="width: calc(100% - 60px) !important"
                placeholder="pesquisar" id="">
                <button type="submit" style="width: 50px !important" class="border-0 bg-white px-3 rounded"><i class="fa fa-search"></i></button>
            </form>
            </nav>

            
        </div>
        
    </header>

    <!-- <div class="info">
        <div class="container">Site de informação especializado em mercados financeiros</div>
    </div> -->
    

    <div class="container mt-3">
        @yield('content')
    </div>

    <div class="footer">
        Desenvolvido por Julião F. Kataleko
    </div>
        

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>