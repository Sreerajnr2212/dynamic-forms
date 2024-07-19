<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

</nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-align:center;">
      <span class="brand-text">DYNAMIC FORM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('admin/form/list')}}" class="nav-link @if(Request::segment(3)=='list') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Form List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/form/add')}}" class="nav-link @if(Request::segment(3)=='add') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
              Add Form
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>