@if (auth()->user()->utype == "USR")
<div x-data="{ dropdownOpen: false }" class="relative my-32">
    <button x-on:click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
            <path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z">
            </path>
        </svg>
        @if (count(auth()->user()->unreadNotifications))
        <div class="notify mt-2"> <span class="heartbit"></span> <span class="point"></span> </div>
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
</div>

@else
<nav class="navbar top-navbar z-50">
<div class="navbar-collapse">
<ul class="navbar-nav my-lg-0">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-bell"></i>
            @if (count(auth()->user()->unreadNotifications))
                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>    
            @endif 
        </a>
        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
            <ul>
                <li>
                    <div class="drop-title">Notificaciones ({{ count(auth()->user()->unreadNotifications) }})</div>
                </li>
                <li>

                    <div class="message-center">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                        <!-- Message -->
                        <a wire:click="markViews" href="{{ route('admin.orderdetails', ['order_id'=>$notification->data['id']]) }}">
                            @if ($notification->data['status'] == "ordered")
                            <div class="btn btn-success btn-circle"><i class="fa fa-shopping-cart muted"></i></div> 
                            @elseif ($notification->data['status'] == "canceled") 
                            <div class="btn btn-danger btn-circle"><i class="fa fa-shopping-cart"></i></div>   
                            @endif
                            <div class="mail-contnet">
                                <h5>{{ $notification->data['firstname'] }} {{ $notification->data['lastname'] }}</h5> 
                                <span class="mail-desc">@if ($notification->data['status'] == "ordered")Realizó una @elseif ($notification->data['status'] == "canceled")Canceló su @endif compra de ({{ $notification->data['total'] }}$)</span> 
                                <span class="time">{{ $notification->created_at->diffForHumans() }}</span> 
                            </div>
                        </a>        
                        @endforeach

                        @forelse (auth()->user()->readNotifications as $notification)
                        <!-- Message -->
                        <a href="{{ route('admin.orderdetails', ['order_id'=>$notification->data['id']]) }}">
                            @if ($notification->data['status'] == "ordered")
                            <div class="btn btn-secondary btn-circle text-muted"><i class="fa fa-shopping-cart muted"></i></div> 
                            @elseif ($notification->data['status'] == "canceled") 
                            <div class="btn btn-secondary btn-circle text-muted"><i class="fa fa-shopping-cart"></i></div>   
                            @endif
                            <div class="mail-contnet">
                                <h5 class="text-muted">{{ $notification->data['firstname'] }} {{ $notification->data['lastname'] }}</h5> 
                                <span class="mail-desc text-muted">@if ($notification->data['status'] == "ordered")Realizó una @elseif ($notification->data['status'] == "canceled")Canceló su @endif compra de ({{ $notification->data['total'] }}$)</span> 
                                <span class="time text-muted">{{ $notification->created_at->diffForHumans() }}</span> 
                            </div>
                        </a>         
                        @empty
                            
                        @endforelse
                            
                    </div>
                </li>
                @if (count(auth()->user()->unreadNotifications))
                <li>
                    <a class="nav-link text-center link" href="{{ route('markReadAdmin') }}"> <strong>Marcar todas como leídas</strong> <i class="fa fa-angle-right"></i> </a>
                </li>
                @endif
            </ul>
        </div>       
    </li>
</ul> 
</div>   
</nav>
@endif