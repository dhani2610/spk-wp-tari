<!-- ========== Left Sidebar Start ========== -->
<style>
span{
    color: white;
}
#sidebar-menu{
    background: #4e73df;
}
.simplebar-content-wrapper{
    background: #4e73df!important;
}
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" style="background:#4e73df">
                @if(auth()->user()->can('dashboard') || auth()->user()->can('master-data') || auth()->user()->can('history-log-list'))
                <li class="menu-title" key="t-menu">Menu</li>
                @endif

                {{-- @if(auth()->user()->can('dashboard'))
                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @endif --}}

                @if(auth()->user()->can('main-menu'))
                <li>
                    <a href="{{ route('master-data.index') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Main Menu</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('sanggar-tari'))
                <li>
                    <a href="{{ route('sanggar-tari-list') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Sanggar Tari Tradisional</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('data-alternatif'))
                <li>
                    <a href="{{ route('data-alternatif-list') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Data Alternatif</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('data-kriteria'))
                <li>
                    <a href="{{ route('data-kriteria-list') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Data Kriteria</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('data-pembobotan'))
                <li>
                    <a href="{{ route('data-pembobotan-list') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Data Pembobotan</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('data-perhitungan'))
                <li>
                    <a href="{{ route('perhitungan') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Data Perhitungan</span>
                    </a>
                </li>
                @endif
            
            

                <li>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn" style="color: white;background: red;margin-left: 9%;"> 
                            <i class="mdi mdi-logout"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->