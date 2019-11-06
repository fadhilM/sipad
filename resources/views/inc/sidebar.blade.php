  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('AdminLte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="USR IMG">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{route("home")}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        @if(Auth::user()->id_hak_akses==3)
          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i> <span>User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              
              <li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i>Lihat User</a></li>
              <li><a href="{{route('register')}}"><i class="fa fa-circle-o"></i>Register User</a></li>
            </ul>
          </li>
        @endif
        @if(Auth::user()->id_hak_akses!=1)
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>Kategori</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              {{-- {{route('kategori.index')}} --}}
              <li><a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i>Lihat Kategori</a></li>
              <li><a href="{{route('category.create')}}"><i class="fa fa-circle-o"></i>Register Kategori</a></li>
            </ul>
          </li>
        @endif
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i>
            <span>Surat Masuk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('suratMasuk.index')}}"><i class="fa fa-circle-o"></i>Lihat Surat Masuk</a></li>
            @if(Auth::user()->id_hak_akses!=2)
            <li><a href="{{route('suratMasuk.create')}}"><i class="fa fa-circle-o"></i>Register Surat Masuk</a></li>
            @endif
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-reply"></i> <span>Surat Keluar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('suratKeluar.index')}}"><i class="fa fa-circle-o"></i>Lihat Surat Keluar</a></li>
            @if(Auth::user()->id_hak_akses!=2)
            <li><a href="{{route('suratKeluar.create')}}"><i class="fa fa-circle-o"></i>Register Surat Keluar</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>