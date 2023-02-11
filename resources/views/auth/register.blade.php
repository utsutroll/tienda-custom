<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ url('dist/new/img/logos/logo-meka.png') }}" class="w-30 h-20 fill-current text-gray-500" alt="Inversiones Meka">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <a class="text-gray-900 hover:text-gray-700 hover:underline" href="/"><i class="far fa-chevron-left"></i> <span class="mr-4">Volver</span></a>


        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            <!-- LastName -->
            <div class="mt-4">
                <x-label for="lastname" :value="__('Apellido')" />

                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Correo electrónico')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-8">
                <div class="relative">
                  <select name="document" :value="old('document')" required class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="CÉDULA DE IDENTIDAD">CÉDULA DE IDENTIDAD</option>
                    <option value=" CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                    <option value="RIF PERSONA JURÍDICA">RIF PERSONA JURÍDICA</option>
                    <option value="RIF PERSONA NATURAL">RIF PERSONA NATURAL</option>
                    <option value="RIF-V">RIF-V</option>
                    <option value="RIF-E">RIF-E</option>
                    <option value="RIF-G">RIF-G</option>
                    <option value="PASAPORTE">PASAPORTE</option>
                  </select>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="document_number" :value="__('Numero de Documento')" />

                <x-input id="document_number" class="block mt-1 w-full" type="text" name="document_number" :value="old('document_number')" required />
            </div>

            <div class="mt-4">
                <x-label for="sexo" :value="__('Sexo')" />
                
                <div class="relative">
                  <select name="sexo" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sexo">
                    <option value="">Seleccione</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                  </select>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('Estoy de acuerdo con los :terms_of_service ', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terminos y Condiciones').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end my-4 ">
                <a class="underline text-lg text-gray-900 font-medium hover:text-gray-700" href="{{ route('login') }}">
                    {{ __('Ya está registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
