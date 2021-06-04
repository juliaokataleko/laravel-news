@extends('layouts.client')

@section('content')

    @if(request('query'))
        <h1 class="main-title"> {{ count($posts) }} resultado(s) para : {{ request('query') }}</h1>
    @else
        <h1 class="main-title">Site de Notícias</h1>
    @endif
    

    <section class="news">

        @foreach ($posts as $post)
            <div>
                @php
                    $img_number = rand(1,6);
                @endphp
                <img src="{{ asset('images/img_'.$img_number.'.jpg') }}" alt="">
                <p class="title">{{ $post->title }}</p>
                <a href="{{ route('post', $post->slug) }}">Acessar</a>
            </div>
        @endforeach
    
    
    </section>

@endsection
