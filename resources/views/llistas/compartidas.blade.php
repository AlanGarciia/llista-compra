@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 1200px;">
    <h1 class="mb-4 text-center fw-bold text-primary display-6">
        Llistes compartides amb mi
    </h1>

    <p class="text-center text-muted mb-5">
        Aquí pots veure i editar les llistes que altres usuaris han compartit amb tu.
    </p>

    @if(session('success'))
        <div class="alert alert-success text-center shadow-sm rounded-3 d-flex justify-content-center align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-4 text-success"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="row g-4 justify-content-center">
        @forelse($llistas as $llista)
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <div class="card-body p-4 bg-light">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title mb-0 text-dark fw-bold">{{ $llista->titol }}</h5>
                            @if($llista->categoria)
                                <span class="badge bg-primary-subtle text-primary px-3 py-2">{{ $llista->categoria->nom }}</span>
                            @endif
                        </div>

                        @if($llista->descripcio)
                            <p class="text-muted small mb-4">{{ $llista->descripcio }}</p>
                        @endif

                        {{-- PRODUCTES --}}
                        <ul class="list-group mb-3">
                            @foreach($llista->productes as $producte)
                                <li class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 py-3">

                                    {{-- CHECKBOX COMPRAT --}}
                                    <form action="{{ route('productes.toggleComprat', $producte->id) }}" method="POST" class="d-flex flex-column align-items-center me-3">
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="compartidas">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                name="comprat" 
                                                id="comprat-{{ $producte->id }}" 
                                                onchange="this.form.submit()" 
                                                {{ $producte->comprat ? 'checked' : '' }}
                                            >
                                        </div>
                                        <small class="text-muted d-block mt-1" style="font-size: 0.8rem;">
                                            Marca si ja l’has comprat
                                        </small>
                                    </form>

                                    {{-- FORM ACTUALITZAR PRODUCTE --}}
                                    <form 
                                        action="{{ route('productes.update', $producte->id) }}" 
                                        method="POST" 
                                        class="d-flex flex-grow-1 align-items-center flex-wrap gap-2"
                                    >
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="redirect_to" value="compartidas">

                                        <input 
                                            type="text" 
                                            name="nom" 
                                            value="{{ $producte->nom }}" 
                                            class="form-control form-control-sm flex-fill" 
                                            required
                                        >

                                        <input 
                                            type="number" 
                                            name="quantitat" 
                                            value="{{ $producte->quantitat }}" 
                                            class="form-control form-control-sm" 
                                            min="1" 
                                            required
                                        >

                                        <select name="categoria_id" class="form-select form-select-sm">
                                            <option value="">Cap categoria</option>
                                            @foreach(\App\Models\Categoria::where('user_id', auth()->id())->get() as $categoria)
                                                <option 
                                                    value="{{ $categoria->id }}" 
                                                    {{ $producte->categoria_id == $categoria->id ? 'selected' : '' }}
                                                >
                                                    {{ $categoria->nom }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button type="submit" class="btn btn-success btn-sm px-3">
                                            <i class="bi bi-check-circle me-1"></i> Actualitzar
                                        </button>
                                    </form>

                                    {{-- BORRAR PRODUCTE --}}
                                    <form action="{{ route('productes.destroy', $producte->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="redirect_to" value="compartidas">
                                        <button type="submit" class="btn btn-danger btn-sm px-3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </li>
                            @endforeach
                        </ul>

                        {{-- FORM AFEGIR NOU PRODUCTE --}}
                        <form 
                            action="{{ route('productes.store') }}" 
                            method="POST" 
                            class="d-flex flex-wrap gap-2 mb-4"
                        >
                            @csrf
                            <input type="hidden" name="llista_id" value="{{ $llista->id }}">
                            <input type="hidden" name="redirect_to" value="compartidas">
                            <input type="text" name="nom" class="form-control flex-fill" placeholder="Nom del producte" required>
                            <input type="number" name="quantitat" class="form-control" placeholder="Quantitat" min="1" required>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Afegir
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted mb-3">No tens cap llista compartida amb tu.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
