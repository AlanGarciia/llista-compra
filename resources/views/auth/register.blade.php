<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-indigo-100">
        <!-- Contenedor -->
        <div class="relative w-full max-w-md bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-10 border border-white/40">

            <!-- Título -->
            <h2 class="text-3xl font-bold text-center text-gray-800 mt-12 mb-3">
                {{ __('Crea el teu compte') }}
            </h2>
            <p class="text-center text-gray-500 mb-8 text-sm">
                {{ __('Uneix-te i comença a gestionar la teva llista amb estil!') }}
            </p>

            <!-- Formulario -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nom -->
                <div>
                    <x-input-label for="name" :value="__('Nom')" class="text-gray-700 font-medium text-sm mb-1" />
                    <x-text-input id="name"
                        class="block w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-2xl p-2.5 text-sm bg-white shadow-sm transition-all duration-200"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-600 text-xs" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium text-sm mb-1" />
                    <x-text-input id="email"
                        class="block w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-2xl p-2.5 text-sm bg-white shadow-sm transition-all duration-200"
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-xs" />
                </div>

                <!-- Contrasenya -->
                <div>
                    <x-input-label for="password" :value="__('Contrasenya')" class="text-gray-700 font-medium text-sm mb-1" />
                    <x-text-input id="password"
                        class="block w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-2xl p-2.5 text-sm bg-white shadow-sm transition-all duration-200"
                        type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-xs" />
                </div>

                <!-- Confirmar Contrasenya -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmar contrasenya')" class="text-gray-700 font-medium text-sm mb-1" />
                    <x-text-input id="password_confirmation"
                        class="block w-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-2xl p-2.5 text-sm bg-white shadow-sm transition-all duration-200"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-600 text-xs" />
                </div>

                <!-- Botón principal -->
                <div class="pt-2">
                    <x-primary-button
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:ring-blue-300 rounded-2xl py-2.5 text-white font-semibold text-sm shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                        {{ __('Registrar-se') }}
                    </x-primary-button>
                </div>

                <!-- Botón secundario -->
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}"
                        class="inline-block w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-2xl py-2.5 text-sm shadow-sm transition-all duration-300 transform hover:-translate-y-0.5">
                        {{ __('Ja tens compte? Inicia sessió') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
