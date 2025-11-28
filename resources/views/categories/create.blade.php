@extends('layouts.app')

@section('content')
<style>
    body {
        background: #e8f5e9;
    }
    .card-custom {
        border: none;
        border-radius: 1rem;
        background: #ffffff;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    .card-header-custom {
        background: linear-gradient(90deg, #66bb6a, #81c784);
        color: #ffffff;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        text-align: center;
    }
    .btn-custom {
        background: #66bb6a;
        border: none;
        color: #ffffff;
        font-weight: bold;
        transition: all 0.2s ease-in-out;
    }
    .btn-custom:hover {
        background: #57a05b;
        transform: scale(1.03);
    }
    .form-control:focus {
        border-color: #66bb6a;
        box-shadow: 0 0 0 0.25rem rgba(102, 187, 106, 0.25);
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom shadow-lg">
                <div class="card-header card-header-custom">
                    <h3 class="mb-0 fw-bold">Crear Categoria</h3>
                </div>
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-semibold">Nom de la categoria</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
                        </div>

                        <button type="submit" class="btn btn-custom w-100 py-2">Crear Categoria</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
```

@endsection