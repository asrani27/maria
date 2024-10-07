
<section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    <li class="{{ (request()->is('superadmin/petugas*')) ? 'active' : '' }}"><a href="/superadmin/petugas"><i class="fa fa-users"></i> <span>Data petugas</span></a></li>
    <li class="{{ (request()->is('superadmin/kategori*')) ? 'active' : '' }}"><a href="/superadmin/kategori"><i class="fa fa-list"></i> <span>Data Kategori</span></a></li>
    <li class="{{ (request()->is('superadmin/cagar*')) ? 'active' : '' }}"><a href="/superadmin/cagar"><i class="fa fa-building"></i> <span>Data Cagar Budaya</span></a></li>
    <li class="{{ (request()->is('superadmin/absensi*')) ? 'active' : '' }}"><a href="/superadmin/absensi"><i class="fa fa-edit"></i> <span>Absensi</span></a></li>
    <li class="{{ (request()->is('superadmin/jadwal*')) ? 'active' : '' }}"><a href="/superadmin/jadwal"><i class="fa fa-eye"></i> <span>Jadwal Monitoring</span></a></li>
    
    <li class="{{ (request()->is('superadmin/laporan*')) ? 'active' : '' }}"><a href="/superadmin/laporan"><i class="fa fa-file"></i> <span>Print Laporan</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @else
        
    <li class="{{ (request()->is('user')) ? 'active' : '' }}"><a href="/user"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    {{-- <li class="{{ (request()->is('user/sm*')) ? 'active' : '' }}"><a href="/user/sm"><i class="fa fa-users"></i> <span>Data SM</span></a></li> --}}
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @endif
    </ul>
    
</section>