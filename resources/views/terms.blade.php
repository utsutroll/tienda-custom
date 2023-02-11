<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div class="sm:justify-center items-center pt-6 sm:pt-0">
                <a href="/">
                    <img src="{{ url('dist/new/img/logos/logo-meka.svg') }}" class="w-30 h-20 fill-current text-gray-500" alt="Inversiones Meka">
                </a>
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                {!! $terms !!}
            </div>
        </div>
    </div>
</x-guest-layout>
