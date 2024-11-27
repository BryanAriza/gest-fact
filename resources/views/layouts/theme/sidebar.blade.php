<div class="sidebar-wrapper sidebar-theme">

    <nav id="compactSidebar">

        <ul class="menu-categories">
            @can('Reports_Index')
            <li class="">
                <a href="{{url('dashboard')}}" class="menu-toggle" data-active="false">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </div>
                        <span>DASHBOARD</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('Gest_Index')
            <li class="menu">
                <a href="#uiGestion" class="menu-toggle" data-active="true" selected>
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-archive">
                                <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                <rect x="1" y="3" width="22" height="5"></rect>
                                <line x1="10" y1="12" x2="14" y2="12"></line>
                            </svg>
                        </div>
                        <span>GESTION </br>DE INVENTARIO</span>
                    </div>
                </a>
            </li>
            @endcan


            @can('Customer_Index')
            <li class="">
                <a href="{{url('clientes')}}" class="menu-toggle" data-active="false">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <span>GESTION </br>DE CLIENTES</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('Sales_Index')
            <li class="menu">
                <a href="#uiSale" class="menu-toggle" data-active="false">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-stop-circle">
                                <circle cx="12" cy="12" r="10"></circle>
                                <rect x="9" y="9" width="6" height="6"></rect>
                            </svg>

                        </div>
                        <span>GESTION DE</br>VENTA</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('Reports_Index')
            <li class="">
                <a href="{{url('dashboard')}}" class="menu-toggle" data-active="false">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </div>
                        <span>DASHBOARD</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('Role_Create')
            <li class="menu">
                <a href="#uiConfig" class="menu-toggle" data-active="false">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-settings">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                </path>
                            </svg>
                        </div>
                        <span>CONFIGURACION</span>
                    </div>
                </a>
            </li>
            @endcan

        </ul>



    </nav>

    <div id="compact_submenuSidebar" class="submenu-sidebar">
        <div class="submenu" id="uiGestion">
            <ul class="submenu-list" data-parent-element="#uiKit">
                @can('Product_Index')
                <li>
                    <a href="{{url('products')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                            </path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>

                        GESTION DE PRODUCTOS</a>
                </li>
                @endcan
                @can('Category_Index')
                <li>
                    <a href="{{url('categories')}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        GESTION DE CATEGORIAS</a>
                </li>
                @endcan

            </ul>
        </div>
        @can('User_Index')
        <div class="submenu" id="uiConfig">
            <ul class="submenu-list" data-parent-element="#uiKit">

                <li>
                    <a href="{{ url('users') }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>


                        USUARIOS</a>
                </li>
                @can('Role_Index')
                <li>
                    <a href="{{url('roles')}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-key">
                            <path
                                d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4">
                            </path>
                        </svg>


                        ROLES</a>
                </li>
                @endcan
                @can('Permission_Index')
                <li>
                    <a href="{{url('permisos')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>


                        PERMISOS</a>
                </li>
                @endcan
                @can('Asignar_Index')
                <li>
                    <a href="{{url('asignar')}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>

                        ASIGNAR PERMISOS</a>
                </li>
                @endcan

            </ul>
        </div>
        @endcan

        @can('Sales_Index')
        <div class="submenu" id="uiSale">
            <ul class="submenu-list" data-parent-element="#uiKit">
                @can('Sales_Create')
                <li>
                    <a href="{{url('productosVenta')}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                            </path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>


                        REALIZAR COMPRA</a>
                </li>
                @endcan
                @can('Sales_Create')
                <li>
                    <a href="{{url('ventaPos')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>

                        CARRITO DE COMPRAS</a>
                </li>
                @endcan

            </ul>
        </div>
        @endcan


        @can('Reports_Index')
        <div class="submenu" id="uiReports">
            <ul class="submenu-list" data-parent-element="#uiKit">

                <li>
                    <a href="{{url('reporVentas')}}"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 18 18">
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z" />
                            </svg>


                        REPORTE VENTAS REALIZADAS</a>
                </li>

            </ul>
        </div>
        @endcan



    </div>
</div>

<div id="compact_submenuSidebar" class="submenu-sidebar" style="display: none!important">
</div>

<style>
.sidebar-wrapper #compactSidebar .menu-categories a.menu-toggle:hover {
    background: #f1a40b;
    border-radius: 15px;
}
</style>