@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Afegir producte a: {{ $llista->titol }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('productes.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="llista_id" value="{{ $llista->id }}">

                        {{-- Nom del producte --}}
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom del producte</label>
                            <input type="text" name="nom" id="nom" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Quantitat --}}
                        <div class="mb-3">
                            <label for="quantitat" class="form-label">Quantitat</label>
                            <input type="number" name="quantitat" id="quantitat" 
                                   class="form-control @error('quantitat') is-invalid @enderror" 
                                   value="{{ old('quantitat', 1) }}" min="1" required>
                            @error('quantitat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Categoria --}}
                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoria (opcional)</label>
                            <select name="categoria_id" id="categoria_id" class="form-select">
                                <option value="">Cap categoria</option>
                                @foreach($categories as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Afegir Producte</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection