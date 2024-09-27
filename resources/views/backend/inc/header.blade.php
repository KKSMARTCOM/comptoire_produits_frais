<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('panel.index') }}"><img
                src="{{ asset('backend/images/logo.svg') }}" class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('panel.index') }}"><img
                src="{{ asset('backend/images/logo.svg') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        {{-- <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Rechercher maintenant"
                        aria-label="search" aria-describedby="search">
                </div>
            </li>
        </ul> --}}
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="icon-bell mx-0"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Erreur d'application</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                Tout à l' heure
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="ti-settings mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Paramètres</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                Message privé
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                                <i class="ti-user mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Utilisateur enrégistré</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                Depuis 2 jrs
                            </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="{{ asset('backend/images/faces/face28.jpg') }}" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <!-- Afficher le nom de l'utilisateur connecté -->
                    <a class="dropdown-item">
                        <i class="ti-user text-primary"></i>
                        {{ Auth::user()->name }} : {{ Auth()->user()->role == 0 ? 'Administrateur' : 'Utilisateur' }}
                        <!-- Affiche le nom et le rôle de l'utilisateur -->
                    </a>

                    <!-- Afficher la date et l'heure de connexion -->
                    <a class="dropdown-item">
                        <i class="ti-calendar text-primary"></i>
                        Connecté.e le : {{ \Carbon\Carbon::now()->format('d/m/Y') }} à
                        {{ \Carbon\Carbon::now()->format('H:i') }}
                    </a>

                    <!-- Formulaire de déconnexion -->
                    <form class="dropdown-item" id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <i class="ti-power-off text-primary"></i>
                        <button style="background: none;border:none" type="submit">Se déconnecter</button>
                    </form>
                </div>
            </li>

            {{-- <li class="nav-item nav-settings d-none d-lg-flex">
                <a class="nav-link" href="#">
                    <i class="icon-ellipsis"></i>
                </a>
            </li> --}}
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
