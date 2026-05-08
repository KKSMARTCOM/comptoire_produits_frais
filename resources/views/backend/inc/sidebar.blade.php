<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('panel.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (auth()->user()->hasRole('superadmin'))
            <li class="nav-item {{ request()->routeIs('panel.section*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('panel.section.index') }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Sections</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('panel.category*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('panel.category.index') }}">
                    <i class="icon-layers menu-icon"></i>
                    <span class="menu-title">Catégories</span>
                </a>
            </li>
        @endif
        <li class="nav-item {{ request()->routeIs('panel.product*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.product.index') }}">
                <i class="icon-folder menu-icon"></i>
                <span class="menu-title">Produits</span>
            </a>
        </li>
        @if (auth()->user()->hasRole('admin'))
            <li class="nav-item {{ request()->routeIs('panel.promotions*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('panel.promotions.index') }}">
                    <i class="icon-zoom-out menu-icon"></i>
                    <span class="menu-title">Promotions</span>
                </a>
            </li>
        @endif
        <li class="nav-item {{ request()->routeIs('panel.pack*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.pack.index') }}">
                <i class="icon-box menu-icon"></i>
                <span class="menu-title">Coffrets</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.order*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.order.index') }}">
                <i class="icon-bag menu-icon"></i>
                <span class="menu-title">Commandes</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('panel.user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.user.index') }}">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Utilisateurs</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('panel.setting*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.setting.index') }}" data-toggle="collapse"
                data-target="#parametresSubMenu" aria-expanded="false" aria-controls="parametresSubMenu">
                <i class="icon-cog menu-icon"></i>
                <span class="menu-title">Paramètres</span>
            </a>
            <div class="collapse" id="parametresSubMenu">
                <div class="collapse" id="parametresSubMenu">
                    <ul style="padding: 0px 0px 0px 30px" class="nav flex-column sub-menu">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('panel.password.request') }}">Changer mot de
                                passe</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('panel.setting.index') }}">Profil</a>
                        </li>
                        @if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('panel.setting.logs') }}">Historique</a>
                            </li>
                        @endif
                    </ul>
                </div>
        </li>

    </ul>
</nav>

<script>
    $(document).ready(function() {
        $('#parametresSubMenu').on('hidden.bs.collapse', function() {
            console.log('Sous-menu Paramètres caché');
        });

        $('#parametresSubMenu').on('shown.bs.collapse', function() {
            console.log('Sous-menu Paramètres visible');
        });
    });
</script>
