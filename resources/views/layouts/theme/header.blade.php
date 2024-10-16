@if(Auth::check())

<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm" style="background-color:#6a5330 !important;">
        
        
        
        <ul class="navbar-item flex-row">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-list">
                    <line x1="8" y1="6" x2="21" y2="6"></line>
                    <line x1="8" y1="12" x2="21" y2="12"></line>
                    <line x1="8" y1="18" x2="21" y2="18"></line>
                </svg>
            </a>


        </ul>
        <img src="{{ asset('assets/img/logo-fast.ico') }}" alt="logo" style="width:5%;text-align: center;">
        <h1 style="color:white;">Gest-Fact</h1>


        <livewire:search-controller>

            <ul class="navbar-item flex-row navbar-dropdown">


                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-cog text-dark"></i>
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp"
                        aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <img src="{{ asset('assets/img/avatar.jpg') }}" class="img-fluid mr-2" alt="avatar">
                                <div class="media-body">
                                    <h5>{{Auth()->user()->first_name}}</h5>
                                    <p>{{auth()->user()->rol}}</p>
                                </div>
                            </div>
                        </div>
                        @can('Profile_Index')
                        <div class="dropdown-item">
                            <a href="{{url('profile')}}">
                                <i class="fas fa-user"></i>
                                <span>Mi Perfil</span>
                            </a>
                        </div>
                        @endcan

                        @can('Password_Index')
                        <div class="dropdown-item">
                            <a href="{{url('password')}}">
                                <i class="fas fa-lock"></i>
                                <span>Contraseña</span>
                            </a>
                        </div>
                        @endcan


                        <div class="dropdown-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg> <span>Salir</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
    </header>
</div>
@else
<script>
window.location = "/";
</script>
@endif