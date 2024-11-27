<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Gest-Fact | Gestión Inventario</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{ asset('assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
    <!--reCATCHA-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">
</head>

<body class="form">


    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                    <img src="{{ asset('assets/img/login_logo.png') }}" alt="" style="width:110%;">
                        <form class="text-left mt-5" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="email" name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Ingresa correo electronico" value="{{ old('email') }}" required
                                        autocomplete="email" autofocus>
                                    @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Ingresa la contraseña" required autocomplete="current-password">
                                    @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="field-wrapper-captcha input" style="align-items: center;">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}

                                </div>
                                @error ('g-recaptcha-response')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror


                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-dark btn-block" value="">Iniciar
                                        Sesión</button>
                                </div>

                            </div>
                        </form>
                        <p class="terms-conditions text-center">© 2024 All Rights Reserved. <a
                                href="" target="">Gest-Fact</a>
                            <br>versión 1.0
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">

        </div>
    </div>

</body>

</html>