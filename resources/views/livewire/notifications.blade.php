<li x-data="{ dropdownOpen: false }" class="relative">
    <button x-on:click="dropdownOpen = !dropdownOpen" class="relative z-10 block p-2 focus:outline-none">
        <i class="far fa-bell"></i>
        @if (count(auth()->user()->unreadNotifications))
        <span class="flex absolute text-sm noty animate-pulse"><span class="rounded-full h-3 w-3 bg-red-600"></span></span>
        @endif
    </button>
            
    <div x-show="dropdownOpen" x-on:click="dropdownOpen = false" class="z-40 absolute inset-0 h-full w-full"></div>
            
    <div x-show="dropdownOpen" 
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95" 
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75" 
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="z-50 absolute right-0 bg-white rounded shadow-lg border" style="width:20rem;">
        <h5 class="block text-gray-800 text-center font-bold m-0 border-b py-2">
            Notificaciones ({{ count(auth()->user()->unreadNotifications) }})
        </h5>
        <div class="">
            @foreach (auth()->user()->unreadNotifications as $notification)
            <a wire:click.prevent="markViews" href="{{ route('admin.orderdetails', ['order_id'=>$notification->data['id']]) }}"
                class="flex items-center px-4 py-3 hover:bg-gray-100">
                @if ($notification->data['status'] == "approved")
                <div class="btn btn-success btn-circle"><i class="fa fa-shopping-cart muted"></i></div>
                @elseif ($notification->data['status'] == "declined")
                <div class="btn btn-danger btn-circle"><i class="fa fa-shopping-cart"></i></div>
                @endif
                <p class="text-gray-600 text-sm m-2">
                    <span class="font-bold">@if ($notification->data['status'] == "approved") Se Aprobó @elseif($notification->data['status'] == "declined")Se Canceló @endif</span> <br>
                    <span class="mail-desc">Su compra #{{ $notification->data['id'] }} ({{ $notification->data['total'] }}$)</span> <br>
                    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                </p>
            </a>
            @endforeach
            
            @forelse (auth()->user()->readNotifications as $notification)
            <a href="{{ route('user.orderdetails', ['order_id'=>$notification->data['id']]) }}"
                class="flex items-center px-4 py-3 hover:bg-gray-100">
                @if ($notification->data['status'] == "approved")
                <div class="btn btn-secondary btn-circle text-muted"><i class="fa fa-shopping-cart muted"></i></div>
                @elseif ($notification->data['status'] == "declined")
                <div class="btn btn-secondary btn-circle text-muted"><i class="fa fa-shopping-cart"></i></div>
                @endif
                <p class="text-gray-600 text-sm mx-2">
                    <span class="font-bold text-muted">@if ($notification->data['status'] == "approved") Se Aprobó @elseif ($notification->data['status'] == "declined")Se Canceló @endif</span> <br>
                    <span class="mail-desc text-muted">Su compra #{{ $notification->data['id'] }} ({{ $notification->data['total'] }}$)</span> <br>
                    <span class="time text-muted">{{ $notification->created_at->diffForHumans() }}</span>
                </p>
            </a>
            @empty

            @endforelse
            
            @if (count(auth()->user()->unreadNotifications))
            <a href="{{ route('markReadUser') }}" class="block text-gray-800 text-center font-bold py-2 border-t">Marcar
                todas como Leídas</a>
            @endif
        </div>
    </div>
</li>