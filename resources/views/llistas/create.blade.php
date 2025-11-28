@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Crear Llista</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('llistas.store') }}" method="POST">
                        @csrf
                        {{-- Titol --}}
                        <div class="mb-3">
                            <label for="titol" class="form-label">Nom de la llista</label>
                            <input type="text" name="titol" id="titol" 
                                   class="form-control @error('titol') is-invalid @enderror" 
                                   value="{{ old('titol') }}" required>
                            @error('titol')
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

                        {{-- Descripcio --}}
                        <div class="mb-3">
                            <label for="descripcio" class="form-label">Descripció (opcional)</label>
                            <textarea name="descripcio" id="descripcio" 
                                      class="form-control" rows="3">{{ old('descripcio') }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Crear Llista</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection