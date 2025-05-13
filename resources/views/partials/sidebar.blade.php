
<!--**********************************
    Sidebar start
***********************************-->
<div class="dlabnav border-right">
    <div class="dlabnav-scroll">
        <p class="menu-title style-1">Usuario</p>
        <ul class="metismenu" id="menu">
            @if(auth()->check())
                @if(auth()->user()->id_rol == 1) {{-- 1 = ADMIN --}}
                    <!-- Admin sees all menu sections -->
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-grid"></i>
                            <span class="nav-text">Cliente</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/">Inicio</a></li>
                            <li><a href="food-order.html">Mis ordenes</a></li>
                            <li><a href="favorite-menu.html">Mis favoritos</a></li>
                            <li><a href="bill.html">Historial</a></li>    
                            <li><a href="notification.html">Notificaciones</a></li>    
                            <li><a href="setting.html">Configuraciones</a></li>    
                        </ul>
                    </li>
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-shop-window"></i>
                            <span class="nav-text">Estacion90</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="menu.html">Menu</a></li>
                            <li><a href="orders.html">Ordenes</a></li>
                            <li><a href="customer-reviews.html">Comentarios</a></li>
                            <li><a href="restro-setting.html">Configuraciones</a></li>
                            <li><a href="/productos">Productos</a></li>
                            <li><a href="/menuSemanal">Menu Semanal</a></li>
                            <li><a href="/usuarios">Usuarios</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="bi bi-bicycle"></i>
                            <span class="nav-text">Delivery</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="deliver-main.html">Inicio</a></li>
                            <li><a href="deliver-order.html">Ordenes</a></li>
                            <li><a href="feedback.html">Comentario</a></li>
                        </ul>
                    </li>
                @else
                    <!-- Non-admin users see only their relevant section based on role -->
                    @if(auth()->user()->id_rol == 2) {{-- 2 = CLIENTE --}}
                        <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                                <i class="bi bi-grid"></i>
                                <span class="nav-text">Cliente</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="/">Inicio</a></li>
                                <li><a href="food-order.html">Mis ordenes</a></li>
                                <li><a href="favorite-menu.html">Mis favoritos</a></li>
                                <li><a href="bill.html">Historial</a></li>    
                                <li><a href="notification.html">Notificaciones</a></li>    
                                <li><a href="setting.html">Configuraciones</a></li>    
                            </ul>
                        </li>
                    @endif
                    
                    @if(auth()->user()->id_rol == 4) {{-- 4 = CHEF --}}
                        <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                                <i class="bi bi-shop-window"></i>
                                <span class="nav-text">Estacion90</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="dashboard.html">Dashboard</a></li>
                                <li><a href="menu.html">Menu</a></li>
                                <li><a href="orders.html">Ordenes</a></li>
                                <li><a href="customer-reviews.html">Comentarios</a></li>
                                <li><a href="restro-setting.html">Configuraciones</a></li>
                                <li><a href="/productos">Productos</a></li>
                                <li><a href="/menuSemanal">Menu Semanal</a></li>
                                <!-- Usuario link removed for Chef role -->
                            </ul>
                        </li>
                    @endif
                    
                    @if(auth()->user()->id_rol == 3) {{-- 3 = REPARTIDOR --}}
                        <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-bicycle"></i>
                                <span class="nav-text">Delivery</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="deliver-main.html">Inicio</a></li>
                                <li><a href="deliver-order.html">Ordenes</a></li>
                                <li><a href="feedback.html">Comentario</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
            @else
                <!-- Show minimal options for guests -->
                <li><a href="/login">Iniciar sesión</a></li>
            @endif
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->