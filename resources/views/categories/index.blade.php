@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary mb-2">Categories</h1>
        <p class="text-muted">Gestiona i organitza les teves categories fàcilment.</p>
        <a href="{{ route('categories.create') }}" class="btn btn-success shadow-sm mt-2">
            Crear nova categoria
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($categories->isEmpty())
        <div class="text-center mt-5">
            <p class="text-muted fs-5">Encara no tens cap categoria</p>
        </div>
    @else
        <div class="d-flex flex-column align-items-center gap-3">
            @foreach ($categories as $categoria)
                <div class="card shadow-sm w-75 border-0 category-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-folder-fill text-warning fs-3"></i>
                            <h5 class="mb-0 fw-semibold">{{ $categoria->nom }}</h5>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('categories.edit', $categoria) }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-pencil"></i>Editar
                            </a>
                            <form action="{{ route('categories.destroy', $categoria) }}" method="POST" onsubmit="return confirm('Segur que vols eliminar aquesta categoria?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i>Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<style>
    .category-card {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .category-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
