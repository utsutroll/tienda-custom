<div class="p-2 md:p-4 lg:p-4 m-2 md:m-4 lg:m-4">
    <div class="py-4 px-5 my-2 text-gray-900 rounded-md text-sm border-b border-gray-200">
        <div class="flex">
            <div class="flex-1 justify-items-start mt-4 md:mt-0 lg:mt-0">
                <h4 class="text-lg font-sans font-semibold">Panel Administrativo</h4>
            </div>

            <ul class="flex justify-items-end">
                <li><a href="{{ route('shop') }}" class="underline font-semibold">Tienda</a></li>
                <li><span class="mx-2">/</span></li>
                <li>Panel Administrativo</li>
            </ul>
        </div>
    </div>

    <div class="my-6 grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-2 md:gap-4 lg:gap-4">
        <div class="cols-1 md:cols-4 lg:cols-4">
            <div class="bg-slate-200 rounded-md shadow-md hover:shadow-lg shadow-orange-500 hover:shadow-orange-500/60 transition duration-700 ease-in-out">
                <div class="p-3 md:p-6 lg:p-6">
                    <div class="flex items-stretch">
                        <div class="flex-1 justify-start">
                            <h3 class="text-2xl"><i class="far fa-money-bill"></i></h3>
                            <p class="text-base text-gray-400 font-sans">Total Gastado</p>
                        </div>
                        <div class="text-end">
                            <h2 class="text-2xl font-semibold font-sans text-orange-500">{{ $users }}$</h2>
                        </div>
                    </div>
                    <div class="mt-2 bg-orange-500 rounded-md">
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cols-1 md:cols-4 lg:cols-4">
            <div class="bg-slate-200 rounded-md shadow-md hover:shadow-lg shadow-blue-500 hover:shadow-blue-500/60 transition duration-700 ease-in-out">
                <div class="p-3 md:p-6 lg:p-6">
                    <div class="flex items-stretch">
                        <div class="flex-1 justify-start">
                            <h3 class="text-2xl"><i class="fad fa-shopping-cart"></i></h3>
                            <p class="text-base text-gray-400 font-sans">Pendientes</p>
                        </div>
                        <div class="text-end">
                            <h2 class="text-2xl font-semibold font-sans text-blue-500">{{ $pending }}</h2>
                        </div>
                    </div>
                    <div class="mt-2 bg-blue-500 rounded-md">
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cols-1 md:cols-4 lg:cols-4">
            <div class="bg-slate-200 rounded-md shadow-md hover:shadow-lg shadow-indigo-500 hover:shadow-indigo-500/60 transition duration-700 ease-in-out">
                <div class="p-3 md:p-6 lg:p-6">
                    <div class="flex items-stretch">
                        <div class="flex-1 justify-start">
                            <h3 class="text-2xl"><i class="far fa-shopping-bag"></i></h3>
                            <p class="text-base text-gray-400 font-sans">Entregados</p>
                        </div>
                        <div class="text-end">
                            <h2 class="text-2xl font-semibold font-sans text-indigo-500">{{ $delivered }}</h2>
                        </div>
                    </div>
                    <div class="mt-2 bg-indigo-500 rounded-md">
                        <div class="progress">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cols-1 md:cols-4 lg:cols-4">
            <div class="bg-slate-200 rounded-md shadow-md hover:shadow-lg shadow-teal-500 hover:shadow-teal-500/60 transition duration-700 ease-in-out">
                <div class="p-3 md:p-6 lg:p-6">
                    <div class="flex items-stretch">
                        <div class="flex-1 justify-start">
                            <h3 class="text-2xl"><i class="far fa-ban"></i></h3>
                            <p class="text-base text-gray-400 font-sans">Cancelados</p>
                        </div>
                        <div class="text-end">
                            <h2 class="text-2xl font-semibold font-sans text-teal-500">{{ $canceled }}</h2>
                        </div>
                    </div>
                    <div class="mt-2 bg-teal-500 rounded-md">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
