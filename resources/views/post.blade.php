@extends('layouts.client')

@section('content')

    @php
        $post->read;
    @endphp
    <div class="post-top">
        <h1>{{ $post->title }}</h1>
        <a href="{{ route('home') }}" class=""><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>
        

    <section class="news">

        <div>
            <img src="{{ asset('images/img_1.jpg') }}" alt="">
            <article>
                {!! nl2br($post->body) !!}
            </article>
            <small>
            Categoria: {{ $post->category->name ?? '' }}, Leituras: {{ count($post->reads) }}
            </small>
        </div>

    </section>

@endsection
