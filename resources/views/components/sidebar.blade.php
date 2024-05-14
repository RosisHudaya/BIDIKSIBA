<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a>
            <div class="d-flex justify-content-center">
                <img class="img-fluid my-3 mr-3" style="width: 46px; height: 46px;"
                    src="{{ asset('assets/img/logo.png') }}">
                <div>
                    <p class="mb-0 mt-3" style="color:#78828a; font-size: 20px; font-weight: 800;">BIDIKSIBA</p>
                    <p class="mx-0 mt-0" style="color:#78828a; font-size: 7px; font-weight: 800;">
                        Politeknik Negeri Malang
                    </p>
                </div>
            </div>
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a>
            <img class="img-fluid" style="width: 26px;" src="{{ asset('assets/img/logo.png') }}">
        </a>
    </div>
    <ul class="sidebar-menu">
        @foreach ($menuGroups as $item)
            @can($item->permission_name)
                <li
                    class="nav-item dropdown {{ $item->menuItems->pluck('route')->filter(function ($route) {return request()->is($route . '*');})->count()? 'active': '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="{{ $item->icon }}"></i>
                        <span>{{ $item->name }}</span></a>
                    <ul class="dropdown-menu">
                        @foreach ($item->menuItems as $menuItem)
                            @can($menuItem->permission_name)
                                <li class="{{ request()->is($menuItem->route . '*') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ url($menuItem->route) }}">{{ $menuItem->name }}</a>
                                </li>
                            @endcan
                        @endforeach
                    </ul>
                </li>
            @endcan
        @endforeach
    </ul>
</aside>
