<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('panel.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.category.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.category.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Catégories</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.slider.index') ? 'active' : '' }}">
            <a class="nav-link" {{-- data-toggle="collapse" --}} href="{{ route('panel.slider.index') }}" {{-- aria-expanded="false" aria-controls="ui-basic" --}}>
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Produits</span>
                {{-- <i class="menu-arrow"></i> --}}
            </a>
        </li>
        
        <li class="nav-item {{ request()->routeIs('panel.promotions.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.promotions.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Promotions</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('panel.order.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.order.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Commandes</span>
            </a>
        </li>
        
        <li class="nav-item {{ request()->routeIs('panel.user.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.user.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Utilisateurs</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('panel.contact.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.contact.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Contact</span>
            </a>
        </li>
        {{-- <li
            class="nav-item {{ request()->routeIs('panel.setting.index') || request()->routeIs('panel.setting.create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.setting.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Paramètres</span>
            </a>
        </li> --}}

        <li class="nav-item {{ request()->routeIs('panel.setting.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.setting.index') }}" data-toggle="collapse" data-target="#parametresSubMenu" aria-expanded="false" aria-controls="parametresSubMenu">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Paramètres</span>
            </a>
            <div class="collapse {{ !request()->routeIs('panel.setting.index') ? 'show' : '' }}" id="parametresSubMenu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('panel.setting.index') }}">Confidentialité</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('panel.setting.index') }}">Historique</a>
                    </li>
                </ul>
            </div>
        </li>
        
    </ul>
</nav>
<script>
    $(document).ready(function() {
    $('#parametresSubMenu').on('hidden.bs.collapse', function () {
        console.log('Sous-menu Paramètres caché');
    });

    $('#parametresSubMenu').on('shown.bs.collapse', function () {
        console.log('Sous-menu Paramètres visible');
    });
});
</script>


