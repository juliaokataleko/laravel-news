@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center">
<h1>Nova Publicação</h1>
<a href="{{ route('posts.index') }}" class="btn btn-primary">Voltar</a>
</div>

<hr>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
@if(isset($post))
    <form action="{{ route('posts.update', $post->id) }}" 
        method="post">
        @method('put')
        @csrf
    @else
    <form action="{{ route('posts.store') }}" 
        method="post">
        @csrf
    @endif
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="title">Título</label>
                        <input type="text" class="form-control" 
                        placeholder="Título" value="{{ old('title') ?? ($post->title ?? '') }}"
                        name="title" id="title">
                    </div>

                    <div class="form-group col-12">
                        <label for="body">Notícia</label>
                        <textarea style="min-height: 30vh"
                        cols="30" class="form-control"
                        placeholder="Texto" 
                        name="body" id="body">{{ old('body') ?? ($post->body ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="form-group col-12">
                    <label for="body">Resumo</label>
                    <textarea 
                    cols="10" class="form-control"
                    placeholder="Resumo" 
                    name="resume" class="form-control" id="resume">{{ old('resume') ?? ($post->resume ?? '') }}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="category_id">Categorias</label> <br>
                    <select name="category_id" 
                    id="category_id" 
                    class="form-control">
                        @forelse ($categories as $cat)
                            <option value="{{ $cat->id }}"
                            @if(isset($post) AND $post->category_id == $cat->id) {{ 'selected' }} @endif
                            >{{ $cat->name }}</option>
                        @empty
                            
                        @endforelse
                    </select>
                    
                </div>

                <!-- <div class="form-group col-12">
                    <label for="image">Carregar Imagens</label>
                    <input type="file" class="d-none" multiple name="images[]" id="image">
                </div> -->

            </div>
        </div>

        <div>
            <div class="float-right">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>

    </form>

@endsection
