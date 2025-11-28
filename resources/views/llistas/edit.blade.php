@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 700px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
            <h2 class="fw-bold mb-0">
                ✏️ Editar llista
            </h2>
            <p class="mb-0 small text-white-50">Modifica les dades de la teva llista fàcilment</p>
        </div>

        <div class="card-body p-4 bg-light">
            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="alert alert-success text-center rounded-3 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Formulario de edición --}}
            <form action="{{ route('llistas.update', $llista) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                {{-- Título --}}
                <div class="mb-3">
                    <label for="titol" class="form-label fw-semibold text-primary">
                        Títol de la llista
                    </label>
                    <input 
                        type="text" 
                        name="titol" 
                        id="titol" 
                        class="form-control form-control-lg shadow-sm" 
                        value="{{ old('titol', $llista->titol) }}" 
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="descripcio" class="form-label fw-semibold text-primary">
                        Descripció
                    </label>
                    <textarea 
                        name="descripcio" 
                        id="descripcio" 
                        class="form-control shadow-sm" 
                        rows="3"
                        placeholder="Afegeix una breu descripció de la llista..."
                    >{{ old('descripcio', $llista->descripcio) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="categoria_id" class="form-label fw-semibold text-primary">
                        Categoria
                    </label>
                    <select 
                        name="categoria_id" 
                        id="categoria_id" 
                        class="form-select shadow-sm"
                    >
                        <option value="">Cap categoria</option>
                        @foreach($categories as $categoria)
                            <option 
                                value="{{ $categoria->id }}" 
                                {{ $llista->categoria_id == $categoria->id ? 'selected' : '' }}
                            >
                                {{ $categoria->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('llistas.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Tornar
                    </a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save2 me-1"></i> Guardar canvis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="feedbackModalLabel">Èxit!</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tancar"></button>
      </div>
      <div class="modal-body text-center py-4">
        Els canvis s'han desat correctament ✅
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success w-100" data-bs-dismiss="modal">Acceptar</button>
      </div>
    </div>
  </div>
</div>

{{-- Script JS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const feedbackModalEl = document.getElementById('feedbackModal');
    const feedbackModal = new bootstrap.Modal(feedbackModalEl);

    // Mostrar modal de confirmación de guardado
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Mostrar modal y enviar al cerrar
        feedbackModalEl.addEventListener('hidden.bs.modal', function() {
            form.submit();
        }, { once: true });

        feedbackModal.show();
    });
});
</script>
@endsection
