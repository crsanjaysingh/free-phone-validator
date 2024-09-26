<header class="header">
    <div class="sticky navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/favicon/logo.png') }}" alt="Logo" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="navbar" href="{{ route('home') }}">Home</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="page-scroll" href="#guest-validator-section">Tracking Numbers</a>
                                </li> --}}
                                @if (Route::is('home'))
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#guest-validator-section">Tracking Numbers</a>
                                    </li>
                                @endif
                                @if (auth()->check())
                                    <li class="nav-item">
                                        <a  href="#">API</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="navbar" href="{{ route("pricing") }}">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="navbar" href="{{ route("dashboard") }}">Dashboard</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" id="login-nav" data-login="{{ route('login') }}">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" id="register-nav" data-register="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <!-- navbar collapse -->
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- navbar area -->
</header>
