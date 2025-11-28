<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Llista de la compra') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #a5b4fc, #93c5fd, #bfdbfe);
            background-size: 400% 400%;
            animation: gradientFlow 15s ease infinite;
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Estilo general de los inputs */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            border: 1.5px solid #d1d5db;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            width: 100%;
            background-color: #f9fafb;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus {
            border-color: #3b82f6;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }

        /* Animación del contenedor principal */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(59, 130, 246, 0.3);
        }

        /* Botón principal */
        .btn-primary {
            display: inline-block;
            width: 100%;
            background: linear-gradient(to right, #3b82f6, #2563eb);
            color: white;
            font-weight: 600;
            text-align: center;
            padding: 0.75rem 0;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        /* Footer */
        footer {
            color: #6b7280;
            font-size: 0.875rem;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center px-6 py-10">

        <!-- Logo -->
        <div class="flex flex-col items-center mb-8">
            <a href="/" class="relative group">
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white w-24 h-24 rounded-3xl flex items-center justify-center shadow-2xl transition transform group-hover:scale-105 group-hover:rotate-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                </div>
                <div class="absolute inset-0 rounded-3xl bg-blue-400/40 blur-lg opacity-0 group-hover:opacity-100 transition"></div>
            </a>
            <h1 class="mt-4 text-2xl font-bold text-blue-800 tracking-tight">
                {{ config('app.name', 'Llista de la compra') }}
            </h1>
        </div>

        <!-- Contenedor principal -->
        <div class="w-full sm:max-w-md glass-card p-8">
            {{ $slot }}
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-center">
            <a href="/google-auth/redirect" class="text-sm text-gray-600 underline">SSO amb Google</a>
        </div>

        <!-- Footer -->
        <footer class="mt-8 text-center">
            © {{ date('Y') }} {{ config('app.name') }} — Tots els drets reservats.
        </footer>
    </div>
</body>
</html>
