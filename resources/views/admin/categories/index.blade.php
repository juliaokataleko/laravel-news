@extends('layouts.admin')

@section('content')

    <h1>Categorias</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(!is_null($cat))
    <form action="{{ route('categories.update', $cat->id) }}" 
        method="post">
        @method('put')
        @csrf
    @else
    <form action="{{ route('categories.store') }}" 
        method="post">
        @csrf
    @endif
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" 
            placeholder="Nome da categoria" 
            value="{{ old('name') ?? ($cat->name ?? '')  }}">
            <div class="input-group-append">
                <button class="btn btn-primary" 
                type="submit">Salvar</button>
            </div>
        </div>

    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Slug</th>
                <th>Ações</th>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            
                            
                            <form id="form_{{ $category->id }}" method="post" 
                            onsubmit="return confirm('Tem certeza?');"
                            action="{{ route('categories.destroy', ['category' => $category->id]) }}">
                                <div class="btn-group" role="group">
                                <a href="?cat={{ $category->id }}" class="btn btn-outline-primary">Editar</a>
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