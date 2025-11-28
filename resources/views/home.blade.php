@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Capçalera -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">Benvingut a la teva App de Llistes de la Compra!</h1>
        <p class="lead text-muted">Des d’aquí pots gestionar les teves categories, crear llistes i afegir productes.</p>
        <hr class="w-50 mx-auto border-primary opacity-50">
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-sm-10 col-md-6 col-lg-4">
            <div class="card text-center border-0 shadow-lg h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <i class="bi bi-tags display-3 text-primary mb-3"></i>
                        <h5 class="card-title fw-bold">Categories</h5>
                        <p class="card-text text-muted mt-2">
                            Veure totes les categories creades o afegir-ne de noves.
                        </p>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary px-4">
                            Veure Categories
                        </a>
                        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary px-4">
                            Crear Categoria
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-10 col-md-6 col-lg-4">
            <div class="card text-center border-0 shadow-lg h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <i class="bi bi-card-list display-3 text-success mb-3"></i>
                        <h5 class="card-title fw-bold">Llistes</h5>
                        <p class="card-text text-muted mt-2">
                            Consulta les teves llistes o crea-ne de noves per organitzar les teves compres.
                        </p>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a href="{{ route('llistas.index') }}" class="btn btn-success px-4">
                            Veure Llistes
                        </a>
                        <a href="{{ route('llistas.create') }}" class="btn btn-outline-success px-4">
                            Crear Llista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection