<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">ММТП</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('dashboard') }}"--}}
{{--                       class="nav-link @if(request()->routeIs('dashboard')) active @endif ">--}}
{{--                        <i class="fa fa-users nav-icon"></i>--}}
{{--                        <p>Dashboard</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                       class="nav-link @if(request()->routeIs('profile.edit')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.profile") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('office.edit', \App\Models\Office::all()[0]) }}"
                       class="nav-link @if(request()->routeIs('office.edit', \App\Models\Office::all()[0])) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.office") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('farmers.index') }}"
                       class="nav-link @if(request()->routeIs('farmers.index')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.farmers") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('workers.index') }}"
                       class="nav-link @if(request()->routeIs('workers.index')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.workers") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}"
                       class="nav-link @if(request()->routeIs('reports.index')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.reports") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.workers') }}"
                       class="nav-link @if(request()->routeIs('reports.workers')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.report_worker") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('services.index') }}"
                       class="nav-link @if(request()->routeIs('services.index')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.services") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tractors.index') }}"
                       class="nav-link @if(request()->routeIs('tractors.index')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.tractors") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('types.index') }}"
                       class="nav-link @if(request()->routeIs('types.index')) active @endif ">
                        <i class="fa fa-users nav-icon"></i>
                        <p>{{ __("messages.types") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="{{ route('logout') }}"
                           class="nav-link" onclick="event.preventDefault();
                           this.closest('form').submit();">
                            <i class="fa fa-sign-out-alt nav-icon"></i>
                            <p>{{ __("messages.logout") }}</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
