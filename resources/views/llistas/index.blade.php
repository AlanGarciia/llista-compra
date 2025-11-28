@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 1200px;">
    <h1 class="mb-4 text-center fw-bold text-primary display-6">
        Les meves llistes de compres
    </h1>

    <p class="text-center text-muted mb-5">
        Gestiona fàcilment els teus productes i llistes. Actualitza, afegeix o marca el que ja has comprat.
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

                        <ul class="list-group mb-3">
                            @foreach($llista->productes as $producte)
                                <li class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 py-3">

                                    {{-- CHECKBOX --}}
                                    <form action="{{ route('productes.toggleComprat', $producte->id) }}" method="POST" class="d-flex flex-column align-items-center me-3">
                                        @csrf
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

                                    {{-- FORM ACTUALIZAR PRODUCTE --}}
                                    <form 
                                        action="{{ route('productes.update', $producte->id) }}" 
                                        method="POST" 
                                        class="d-flex flex-grow-1 align-items-center flex-wrap gap-2"
                                    >
                                        @csrf
                                        @method('PUT')

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

                                    {{-- BORRAR PRODUCTO --}}
                                    <button 
                                        type="button" 
                                        class="btn btn-danger btn-sm px-3" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmDeleteProductModal{{ $producte->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    {{-- MODAL CONFIRMAR ELIMINAR PRODUCTO --}}
                                    <div class="modal fade" id="confirmDeleteProductModal{{ $producte->id }}" tabindex="-1" aria-labelledby="deleteProductLabel{{ $producte->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteProductLabel{{ $producte->id }}">Eliminar producte</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tancar"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Estàs segur que vols eliminar el producte <strong>{{ $producte->nom }}</strong>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel·lar</button>
                                                    <form action="{{ route('productes.destroy', $producte->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            @endforeach
                        </ul>

                        {{-- FORM AÑADIR NUEVO PRODUCTO --}}
                        <form 
                            action="{{ route('productes.store') }}" 
                            method="POST" 
                            class="d-flex flex-wrap gap-2 mb-4"
                        >
                            @csrf
                            <input type="hidden" name="llista_id" value="{{ $llista->id }}">
                            <input type="text" name="nom" class="form-control flex-fill" placeholder="Nom del producte" required>
                            <input type="number" name="quantitat" class="form-control" placeholder="Quantitat" min="1" required>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Afegir
                            </button>
                        </form>

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <a href="{{ route('llistas.edit', $llista->id) }}" class="btn btn-warning btn-sm px-3">
                                <i class="bi bi-pencil-square me-1"></i> Editar
                            </a>

                            {{-- NUEVO BOTÓN COMPARTIR --}}
                            <button 
                                type="button" 
                                class="btn btn-info btn-sm px-3 text-white" 
                                data-bs-toggle="modal" 
                                data-bs-target="#compartirLlistaModal{{ $llista->id }}">
                                <i class="bi bi-share me-1"></i> Compartir
                            </button>

                            {{-- MODAL COMPARTIR LLISTA --}}
                            <div class="modal fade" id="compartirLlistaModal{{ $llista->id }}" tabindex="-1" aria-labelledby="compartirLlistaLabel{{ $llista->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-lg">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title" id="compartirLlistaLabel{{ $llista->id }}">
                                                Compartir llista
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tancar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-3 text-muted">
                                                Introdueix el correu electrònic de l’usuari amb qui vols compartir la llista <strong>{{ $llista->titol }}</strong>.
                                            </p>
                                            <form action="{{ route('llistas.compartir', $llista->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label fw-semibold">Correu electrònic:</label>
                                                    <input 
                                                        type="email" 
                                                        name="email" 
                                                        class="form-control" 
                                                        placeholder="exemple@correu.com" 
                                                        required
                                                    >
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel·lar</button>
                                                    <button type="submit" class="btn btn-info text-white">
                                                        <i class="bi bi-send-fill me-1"></i> Enviar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ELIMINAR LLISTA --}}
                            <button 
                                type="button" 
                                class="btn btn-danger btn-sm px-3" 
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmDeleteListModal{{ $llista->id }}">
                                <i class="bi bi-trash3 me-1"></i> Eliminar
                            </button>

                            {{-- MODAL CONFIRMAR ELIMINAR LLISTA --}}
                            <div class="modal fade" id="confirmDeleteListModal{{ $llista->id }}" tabindex="-1" aria-labelledby="deleteListLabel{{ $llista->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteListLabel{{ $llista->id }}">Eliminar llista</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tancar"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Segur que vols eliminar la llista <strong>{{ $llista->titol }}</strong>?</p>
                                            <p class="text-muted small">Això eliminarà tots els productes associats.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel·lar</button>
                                            <form action="{{ route('llistas.destroy', $llista->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted mb-3">Encara no tens cap llista creada.</p>
                <a href="{{ route('llistas.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-circle me-2"></i> Crea la primera!
                </a>
            </div>
        @endforelse
    </div>

    {{-- BOTÓN CREAR LLISTA NUEVA --}}
    @if($llistas->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('llistas.create') }}" class="btn btn-success btn-lg px-4 shadow-sm">
                <i class="bi bi-plus-circle me-2"></i> Crear nova llista
            </a>
        </div>
    @endif
</div>
@endsection
