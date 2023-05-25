
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ url('malinau-kab.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">WPD SEMENGARIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url(Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ set_active('dashboard') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-header">Data Master</li>
                @can('post_show')
                    <li class="nav-item">
                        <a href="{{ route('post.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Sejarah
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('post.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Visi dan Misi
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('post.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Foto
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('datapenduduk.index') }}" class="nav-link {{ set_active(['datapenduduk.*', 'detaildatapenduduk.*']) }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Data Penduduk
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('rt.index') }}" class="nav-link {{ set_active(['rt.*']) }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Data RT
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('kelompoktani.index') }}" class="nav-link {{ set_active(['kelompoktani.*', 'anggotapoktan.*']) }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Data Kelompok Tani
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('sumberdaya.index') }}" class="nav-link {{ set_active(['sumberdaya.*']) }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Data Sumber Daya
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('post.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Data Hasil Sumber Daya
                            </p>
                        </a>
                    </li>
                @endcan


                @can('role_show','user_show')
                <li class="nav-header">Manegement User</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ set_active(['users.index', 'users.show','users.create','users.edit']) }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link {{ set_active(['role.index','role.show', 'role.create','role.edit']) }}">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>
                @endcan




                  {{-- <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                            <button class="btn btn-danger nav-link text-left" >
                                <p style="color: #ffffff">
                                    <i class="fas fa-sign-out-alt" ></i> Logout
                                </p>
                            </button>
                      </form>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
