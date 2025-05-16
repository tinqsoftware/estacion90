<head>
    <!-- ...existing head content... -->
    
    <!-- SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <a href="index.html" class="brand-logo">
        <div class="logo-abbr" width="39" height="31" viewBox="0 0 39 31" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <img src="access/images/logo_white.png" style="height: 50px;" alt="" />
        </div>
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="container d-block my-0">
                <div class="d-flex align-items-center justify-content-sm-end justify-content-end">
                    <ul class="navbar-nav header-right ">
                        <li class="nav-item d-flex align-items-center">

                        </li>
                        <li>
                            <div class="dropdown header-profile2 " @if(Auth::user()) @else style="height:30px;" @endif>
                                <a class="nav-link " href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <div class="header-info2 d-flex align-items-center">
                                        @if(Auth::user())
                                        <img src="access/images/banner-img/user.png" alt="">
                                        @endif
                                        <div class="d-flex align-items-center sidebar-info">
                                            <div>
                                                <h6 class="font-w500 mb-0 ms-2">
                                                    @if(Auth::user())
                                                    {{Auth::user()->name}}
                                                    @else
                                                    Sin usuario
                                                    @endif
                                                </h6>
                                            </div>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>

                                    </div>
                                </a>
                                @if(Auth::user())
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="./app-profile.html" class="dropdown-item ai-icon ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Perfil</span>
                                    </a>

                                    <a href="./notification.html" class="dropdown-item ai-icon ">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                    fill="var(--primary)" />
                                                <circle fill="var(--primary)" opacity="0.3" cx="19.5" cy="17.5"
                                                    r="2.5" />
                                            </g>
                                        </svg>
                                        <span class="ms-2">Notificaciones </span>
                                    </a>

                                     <!-- Change Password Option (New) -->
                                    <a href="{{ route('password.change') }}" class="dropdown-item ai-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4"></path>
                                            <path d="M9 17v-5l3 3 5-5V7"></path>
                                            <path d="M16 3h5v5"></path>
                                        </svg>
                                        <span class="ms-2">Cambiar Contraseña</span>
                                    </a>
                                    
                                    <!-- Reset Password Option 
                                    <a href="#" id="reset-password-btn" class="dropdown-item ai-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            <circle cx="12" cy="16" r="1"></circle>
                                        </svg>
                                        <span class="ms-2">Resetear Contraseña</span>
                                    </a>

                                    -->

                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="dropdown-item ai-icon ms-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ms-1">Salir </span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <!-- Add the reset password form -->
                                    <form id="reset-password-form" action="{{ route('user.reset-password') }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @else
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="/login" class="dropdown-item ai-icon ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Iniciar sesión</span>
                                    </a>
                                </div>
                                @endif

                            </div>

                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Add this script at the end of the body -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const resetBtn = document.getElementById('reset-password-btn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Se restablecerá tu contraseña a la predeterminada y se cerrará tu sesión actual.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, restablecer',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reset-password-form').submit();
                }
            });
        });
    }
});
</script>
<!--**********************************
    Header end ti-comment-alt
***********************************-->