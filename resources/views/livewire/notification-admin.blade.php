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
                                <a wire:click.prevent="markViews({{ $notification->data['id'] }})" href="javascript:void(0)">
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
 