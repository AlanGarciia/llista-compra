@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-center">
        <div class="card shadow-sm w-50">
            <div class="card-header bg-primary text-white fw-bold">
            Editar Categoria
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('categories.update', $categoria) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de la Categoria</label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $categoria->nom) }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                            Tornar
                        </a>
                        <button type="submit" class="btn btn-success">
                            Guardar canvis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection