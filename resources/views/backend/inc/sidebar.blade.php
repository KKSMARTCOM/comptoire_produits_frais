<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('panel.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (auth()->user()->hasRole('superadmin'))
            <li
                class="nav-item {{ request()->routeIs('panel.category.index') || request()->routeIs('panel.category.create') || request()->routeIs('panel.category.edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('panel.category.index') }}">
                    <i class="icon-layers menu-icon"></i>
                    <span class="menu-title">Catégories</span>
                </a>
            </li>
        @endif
        <li
            class="nav-item {{ request()->routeIs('panel.product.index') || request()->routeIs('panel.product.create') || request()->routeIs('panel.product.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.product.index') }}">
                <i class="icon-map menu-icon"></i>
                <span class="menu-title">Produits</span>
            </a>
        </li>
        @if (auth()->user()->hasRole('admin'))
            <li class="nav-item {{ request()->routeIs('panel.promotions.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('panel.promotions.index') }}">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Promotions</span>
                </a>
            </li>
        @endif
        <li
            class="nav-item {{ request()->routeIs('panel.pack.index') || request()->routeIs('panel.pack.edit') || request()->routeIs('panel.pack.create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.pack.index') }}">
                <i class="icon-box menu-icon"></i>
                <span class="menu-title">Coffrets</span>
            </a>
        </li>
        <li
            class="nav-item {{ request()->routeIs('panel.order.index') || request()->routeIs('panel.order.edit') || request()->routeIs('panel.order.show') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.order.index') }}">
                <i class="icon-bag menu-icon"></i>
                <span class="menu-title">Commandes</span>
            </a>
        </li>

        <li
            class="nav-item {{ request()->routeIs('panel.user.index') || request()->routeIs('panel.user.edit') || request()->routeIs('panel.user.create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.user.index') }}">
                <i class="icon-eye menu-icon"></i>
                <span class="menu-title">Utilisateurs</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('panel.setting.index') ? 'active' : '' }}">
            <<<<<<< HEAD <a class="nav-link" href="{{ route('panel.setting.index') }}" data-toggle="collapse"
                data-target="#parametresSubMenu" aria-expanded="false" aria-controls="parametresSubMenu">
                <i class="icon-cog menu-icon"></i>
                <span class="menu-title">Paramètres</span>
                </a>
                <div class="collapse {{ !request()->routeIs('panel.setting.index') ? 'show' : '' }}"
                    id="parametresSubMenu">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('panel.setting.index') }}">Profil</a>
                            =======
                            <a class="nav-link" href="{{ route('panel.setting.index') }}" data-toggle="collapse"
                                data-target="#parametresSubMenu" aria-expanded="false"
                                aria-controls="parametresSubMenu">
                                <i class="icon-cog menu-icon"></i>
                                <span class="menu-title">Paramètres</span>
                            </a>
                            <div class="collapse" id="parametresSubMenu">
                                <div class="collapse {{ !request()->routeIs('panel.setting.index') ? 'show' : '' }}"
                                    id="parametresSubMenu">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('panel.password.request') }}">Changer<br>mot de
                                                passe</a>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Profil</a>
                                            >>>>>>> c137c7ab669f75817f8c505b1d988fc43c070277
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('panel.logs.index') }}">Logs</a>
                                        </li>

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
