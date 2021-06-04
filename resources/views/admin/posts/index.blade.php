@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center">
<h1>Publicações</h1>
<a href="{{ route('posts.create') }}" class="btn btn-primary">Publicar</a>
</div>
    

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Título</th>
                <th>Ações</th>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            
                            <form id="form_{{ $post->id }}" method="post" 
                            onsubmit="return confirm('Tem certeza?');"
                            action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                <div class="btn-group" role="group">
                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-outline-primary">Editar</a>
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        Excluir
                                    </button>
                                </div>
                            </form>
                            
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
    
    

@endsection