<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('img/windsor-logo.png') }}" alt="Windsor Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ env('APP_NAME') }}</span><span
            class="brand-text font-weight-light">Teacher</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar sidebar-dark-green">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/teacher/pp/default.svg') }}" class="img-circle elevation-2"
                    alt="Teacher Profile Picture">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::guard('teacher')->user()->name }}
                    @if (Session::get('homeroom_name'))
                        <br /><small>Wali Kelas<br />{{ Session::get('homeroom_name') }}</small>
                    @endif
                    @if (Session::get('subjects'))
                        <br />
                        @foreach (Session::get('subjects') as $key)
                            <span class="badge badge-info mr-2">
                                {{ $key }}
                            </span>
                        @endforeach
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
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Manage Pertemuan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('teacher.pertemuan') }}" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Daftar Pertemuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('teacher.pertemuan.add') }}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Tambah Pertemuan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.report_card') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Rapot
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.logout') }}" class="nav-link">
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
