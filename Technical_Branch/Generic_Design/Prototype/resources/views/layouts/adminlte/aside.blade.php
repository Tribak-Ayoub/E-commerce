<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    {{-- <img src="/assets/images/soli-lms-logo.png"
      alt="SOLI lms Logo"
      class="brand-image img-circle elevation-3"
      style="opacity: .8"> --}}
    <span class="brand-text font-weight-light">Swatch</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
          <a href="{{ route('products.index') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="{{ route('products.index') }}" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
            <p>
              Manage Products
            </p>
          </a>
        </li>
        {{-- <li class="nav-item has-treeview">
          <a href="{{ route('products.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Manage Products
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/Sanction Rules/create.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/Sanction Rules/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>liste Règles</p>
              </a>
            </li>
          </ul>
        </li> --}}


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>