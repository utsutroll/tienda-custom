<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            @if (Auth::user()->utype === 'ADM')
            <a href="{{ route('admin.dashboard') }}" class="ml-4">
                <h2 class="underline font-semibold text-xl text-gray-800 leading-tight hover:text-gray-700">
                    {{ __('Panel Administrativo') }}
                </h2>
            </a>
            @else
            <a href="/" class="ml-4">
                <h2 class="underline font-semibold text-xl text-gray-800 leading-tight hover:text-gray-700">
                    {{ __('Inicio') }}
                </h2>
            </a>
            <a href="{{ route('shop') }}" class="ml-4">
                <h2 class="underline font-semibold text-xl text-gray-800 leading-tight hover:text-gray-700">
                    {{ __('Tienda') }}
                </h2>
            </a>
            <a href="{{ route('user.orders') }}" class="ml-4">
                <h2 class="underline font-semibold text-xl text-gray-800 leading-tight hover:text-gray-700">
                    {{ __('Mis Pedidos') }}
                </h2>
            </a>
            @endif
            
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif --}}

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            {{-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif --}}
        </div>
    </div>
</x-app-layout>
