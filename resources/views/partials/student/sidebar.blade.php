<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('img/windsor-logo.png') }}" alt="Windsor Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ env('APP_NAME') }}</span><span
            class="brand-text font-weight-light">Student</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar sidebar-dark-indigo">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/teacher/pp/default.svg') }}" class="img-circle elevation-2"
                    alt="Teacher Profile Picture">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::guard('student')->user()->name }}
                    @if (Session::get('class_name'))
                        <br /><small>{{ Session::get('class_name') }}</small>
                    @endif
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('student.pertemuan') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Pertemuan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
