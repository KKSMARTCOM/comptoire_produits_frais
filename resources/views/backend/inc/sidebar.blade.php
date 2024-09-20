<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('panel.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (auth()->user()->hasRole('superadmin'))
            <li class="nav-item {{ request()->routeIs('panel.category.index') || request()->routeIs('panel.category.create') || request()->routeIs('panel.category.edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('panel.category.index') }}">
                    <i class="icon-layers menu-icon"></i>
                    <span class="menu-title">Catégories</span>
                </a>
            </li>
        @endif
        <li class="nav-item {{ request()->routeIs('panel.product.index') || request()->routeIs('panel.product.create') || request()->routeIs('panel.product.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.product.index') }}">
                <i class="icon-map menu-icon"></i>
                <span class="menu-title">Produits</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('panel.promotions.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.promotions.index') }}">
                <i class="icon-tag menu-icon"></i>
                <span class="menu-title">Promotions</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.pack.index') || request()->routeIs('panel.pack.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.pack.index') }}">
                <i class="icon-box menu-icon"></i>
                <span class="menu-title">Coffrets</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.order.index') || request()->routeIs('panel.order.edit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.order.index') }}">
                <i class="icon-bag menu-icon"></i>
                <span class="menu-title">Commandes</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('panel.user.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.user.index') }}">
                <i class="icon-eye menu-icon"></i>
                <span class="menu-title">Utilisateurs</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('panel.setting.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.setting.index') }}" data-toggle="collapse" data-target="#parametresSubMenu" aria-expanded="false" aria-controls="parametresSubMenu">
                <i class="icon-cog menu-icon"></i>
                <span class="menu-title">Paramètres</span>
            </a>
            <div class="collapse {{ !request()->routeIs('panel.setting.index') ? 'show' : '' }}" id="parametresSubMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Modifier mot de passe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logs</a>
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
