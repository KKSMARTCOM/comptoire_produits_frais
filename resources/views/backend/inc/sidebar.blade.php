<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('panel.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.slider.index') ? 'active' : '' }}">
            <a class="nav-link" {{-- data-toggle="collapse" --}} href="{{ route('panel.slider.index') }}" {{-- aria-expanded="false" aria-controls="ui-basic" --}}>
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Catégories</span>
                {{-- <i class="menu-arrow"></i> --}}
            </a>
            {{-- <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('panel.slider.index') }}">Slider</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('panel.slider.create') }}">Add Slider</a>
                    </li>
                </ul>
            </div> --}}
        </li>
        <li class="nav-item {{ request()->routeIs('panel.category.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.category.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Produits</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.order.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.order.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Commandes</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.about.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.about.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Utilisateurs</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('panel.contact.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.contact.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Contact</span>
            </a>
        </li>
        <li
            class="nav-item {{ request()->routeIs('panel.setting.index') || request()->routeIs('panel.setting.create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('panel.setting.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Paramètres</span>
            </a>
        </li>
    </ul>
</nav>
