<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ url('dist/new/img/logos/logo-meka.png') }}" class="w-30 h-20 fill-current text-gray-500" alt="Inversiones Meka">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <a class="mb-4 text-gray-900 hover:text-gray-700 hover:underline" href="/"><i class="far fa-chevron-left"></i> <span class="mr-4">Volver</span></a>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Correo electrónico')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-base text-gray-900 font-medium hover:text-gray-700" href="{{ route('password.request') }}">
                        {{ __('¿Ha olvidado su contraseña?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Entrar') }}
                </x-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                <a class="underline text-lg text-gray-900 font-semibold hover:text-gray-700" href="{{ route('register') }}">
                    {{ __('Registrarse') }}
                </a>  
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
