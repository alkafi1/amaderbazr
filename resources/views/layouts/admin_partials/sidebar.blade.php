<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.dashboard')}}" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Category
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('category.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('subcategory.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('childcategory.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Child Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('brand.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('warehouse.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Warehouse</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Product
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('product.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>New Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('product.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Manage</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Offer
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('seo.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>E-campain</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('coupon.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Coupon</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              PIckup Point
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('pickuppoint.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pickup Point</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('seo.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Seo setting</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('page.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Page Create</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('smtp.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> SMTP Setting</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('website.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Website Setting</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item menu-open">
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.changepassword')}}" id="" class="nav-link">
                <i class="far fa-info nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.logout')}}" id="logout" class="nav-link">
                <i class="far fa-delete nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
            
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>