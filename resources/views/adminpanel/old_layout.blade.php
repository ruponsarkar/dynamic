<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('admin/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('admin/assets/css/admin.css')}}">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{url('admin/assets/plugins/bootstrap-5.1/css/bootstrap.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- custom css -->
  <link rel="stylesheet" href="{{url('admin/assets/css/custom.css')}}">
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="admin/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="{{url('admin/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light nav-clr">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" data-enable-remember="true" href="#" role="button"><i class="feather icon-maximize"></i></a>
      </li>
      <li  class="nav-item my-auto f-w-800">
      @yield('breadcrumb')
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ms-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" href="logout">
        <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="feather icon-settings"></i>
        </a>
      </li> -->
</ul>

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-gray elevation-4 ">
<!-- Brand Logo -->
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('admin/assets/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{URL('admin_index')}}" class="d-block text-decoration-none">SIR Publishers</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="{{URL('admin_index')}}" class="nav-link  {{ request()->is('admin_index') ? 'active' : ''}}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL('all-manuscript')}}" class="nav-link {{ request()->is('all-manuscript') ? 'active' : ''}}">
            <i class=" nav-icon fas fa-book-open"></i>
              <p>
              All Manuscript
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL('receive-editors')}}" class="nav-link {{ request()->is('receive-editors') ? 'active' : ''}}">
            <i class="nav-icon fas fa-user-plus"></i>
              <p>
              Editor Request Receive
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL('receive-reviewers')}}" class="nav-link {{ request()->is('receive-reviewers') ? 'active' : ''}}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
              Reviewer Request Receive
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ request()->is('journalForm') ? 'menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book-reader"></i>
              <p>
              Journals
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('journalForm')}}" class="nav-link {{ request()->is('journalForm') ? 'active' : ''}}">
                  <p class="p-4"><i class="fas fa-arrow-right"></i> Add Journals</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <p class="p-4"><i class="fas fa-arrow-right"></i> Update Journals</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ request()->is('addEditors') ? 'menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
              <p>
              Editors
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('addEditors')}}" class="nav-link {{ request()->is('addEditors') ? 'active' : ''}}">
                  <p class="p-4"><i class="fas fa-arrow-right"></i> Add Editors</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ request()->is('add-volume') ? 'menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-swatchbook"></i>
              <p>
              Volume
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL('add-volume')}}" class="nav-link {{ request()->is('add-volume') ? 'active' : ''}}">
                  <p class="p-4"><i class="fas fa-arrow-right"></i> Add Volume</p>
                </a>
              </li>
            </ul>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="{{URL('home-article')}}" class="nav-link {{ request()->is('home-article') ? 'active' : ''}}">-->
          <!--    <i class="nav-icon far fa-calendar-alt"></i>-->
          <!--    <p>-->
          <!--    Home page Article-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <li class="nav-item">
            <a href="{{URL('indexing')}}" class="nav-link {{ request()->is('indexing') ? 'active' : ''}}">
            <i class="nav-icon fas fa-book"></i>
              <p>
              Indexing
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright <a href="https://pageuptechnologies.com">PageUpTechnologies</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="{{url('admin/assets/plugins/bootstrap-5.1/js/bootstrap.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- Admin App -->
<script src="{{url('admin/assets/js/admin.min.js')}}"></script>

<!-- DataTables -->
<script src="{{url('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure you want to Delete?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
    
</script>
</body>
</html>
