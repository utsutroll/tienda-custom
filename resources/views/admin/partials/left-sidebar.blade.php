<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">{{-- <img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> --}}
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="img-circle">
                    <span class="hide-menu">{{ Auth::user()->name }}</span>
                </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('profile.show') }}"><i class="ti-user"></i> Mi Perfil</a></li>
                        <li>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    <i class="fa fa-power-off"></i> {{ __('Cerrar Sesión') }}
                                </a>
                            </form>    
                        </li>
                    </ul>
                </li>
                <li id="LiMenu"> <a class="waves-effect waves-dark" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Menú Principal</span></a></li>
                
                <li class="nav-small-cap">--- Productos</li>
                <li id="LiCategories"> 
                    <a class="waves-effect waves-dark" href="{{route('admin.categories')}}" aria-expanded="false">
                        <i class="icon-layers"></i>
                        <span class="hide-menu">Categoría</span>
                    </a>
                </li>
                <li id="LiSubcategories"> 
                    <a class="waves-effect waves-dark" href="{{route('admin.subcategories')}}" aria-expanded="false">
                        <i class="icon-layers"></i>
                        <span class="hide-menu">Subcategoría</span>
                    </a>
                </li>
                <li id="LiBrand"> 
                    <a class="waves-effect waves-dark" href="{{route('admin.brands')}}" aria-expanded="false">
                        <i class="ti-bookmark"></i>
                        <span class="hide-menu">Marca</span>
                    </a>
                </li>
                <li id="LiCharacteristic"> 
                    <a class="waves-effect waves-dark" href="{{route('admin.characteristics')}}" aria-expanded="false">
                        <i class="ti-agenda"></i>
                        <span class="hide-menu">Característica</span>
                    </a>
                </li>
                <li id="liProducts"> 
                    <a class="waves-effect waves-dark" href="{{route('admin.products.index')}}" aria-expanded="false">
                        <i class="icon-bag"></i>
                        <span class="hide-menu">Producto</span>
                    </a>
                </li>
                <li class="nav-small-cap">--- Almacén</li>
                <li class="LiAmacen"> 
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-home"></i><span class="hide-menu">Entradas & Salidas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li id="liEntry"><a id="AEntry" href="{{route('admin.product-entry.index')}}">Entrada Producto</a></li>
                        <li id="liStock"><a href="{{route('admin.product-entry.stock')}}">Stock</a></li>
                        <li id="liOutput"><a href="{{route('admin.product-output.index')}}">Salida Producto</a></li>
                    </ul>
                </li>
                <li class="nav-small-cap">--- Órdenes de Compra</li>
                <li id="LiOrders"> 
                    <a class="waves-effect waves-dark" href="{{route('admin.orders')}}" aria-expanded="false">
                        <i class="ti-shopping-cart"></i>
                        <span class="hide-menu">Órdenes</span>
                    </a>
                </li>
                <li class="nav-small-cap">--- Promocional</li>
                <li id="LiSlider"> 
                    <a class="waves-effect waves-dark" href="{{route('admin.slider.index')}}" aria-expanded="false">
                        <i class="ti-image"></i>
                        <span class="hide-menu">Slider</span>
                    </a>
                </li> 
                <li id="LiPartner">    
                    <a class="waves-effect waves-dark" href="{{route('admin.business-partners.index')}}" aria-expanded="false">
                        <i class="icon-people"></i>
                        <span class="hide-menu">Aliado Comercial</span>
                    </a>
                </li>                
                <li class="nav-small-cap">--- Actualizar $</li>
                <li> 
                    <a class="waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)">
                        <i class="fa fa-refresh"></i>
                        <span class="hide-menu" data-toggle="modal" data-target="#modalUpdatePrice">Precio de Producto</span>
                    </a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"> 
                        <i class="fa fa-refresh"></i>
                        <span class="hide-menu" data-toggle="modal" data-target="#modalUpdatePriceDolar">Tasa del Dólar</span>
                    </a>
                </li>
                <li id="LiSale"> 
                    <a class="waves-effect waves-dark" aria-expanded="false" href="{{ route('admin.sale') }}"> 
                        <i class="fa fa-refresh"></i>
                        <span class="hide-menu">Ofertas</span>
                    </a>
                </li>
                <li class="nav-small-cap">--- Bancos & Formas de Pago</li>
                <li id="LiBanks"> 
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-bank"></i><span class="hide-menu">Bancos & Billeteras</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('admin.bank-accounts') }}">Cuentas Bancarias</a></li>
                        <li><a href="{{ route('admin.wallets') }}">Billeteras Electrónicas</a></li>
                    </ul>
                </li>
                <li class="nav-small-cap">--- Reportes</li>
                <li id="LiOrderReports"> 
                    <a class="waves-effect waves-dark" href="{{ route('admin.orders.reports') }}" aria-expanded="false">
                        <i class="icon-docs"></i>
                        <span class="hide-menu">Reporte de Pedidos</span>
                    </a>    
                </li>
                @if(auth()->user()->su == "1")
                <li class="nav-small-cap">--- Control de Usuarios</li>
                <li id="LiUser"> 
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-people"></i><span class="hide-menu">Usuarios</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('admin.users') }}">Nuevo Usuario</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>