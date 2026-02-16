<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Start Navbar Links-->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list"></i>
          </a>
        </li>
        <li class="nav-item d-none d-md-block">
            <a href="{{ route('home.index') }}" target="_new" class="nav-link">Home</a></li>
        {{-- <li class="nav-item d-none d-md-block"><a href="{{ route('frontend.about') }}" target="_new" class="nav-link">Contact</a></li> --}}
      </ul>
      <!--end::Start Navbar Links-->
      <!--begin::End Navbar Links-->
      <ul class="navbar-nav ms-auto">
        <!--end::Notifications Dropdown Menu-->
        <!--begin::Fullscreen Toggle-->
        <li class="nav-item">
          <a class="nav-link" href="#" data-lte-toggle="fullscreen">
            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
          </a>
        </li>
        <!--end::Fullscreen Toggle-->
        <!--begin::User Menu Dropdown-->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img
              src="{{ asset('public/assets/images/user_icon.png') }}"
              class="user-image rounded-circle shadow"
              alt="User Image"
            />
            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <!--begin::User Image-->
            <li class="user-header text-bg-primary">
              <img
                src="{{ asset('public/assets/images/user_icon.png') }}"
                class="rounded-circle shadow"
                alt="User Image"
              />
              <p>
                {{ Auth::user()->name }} - {{ Auth::user()->role }}
                <small>Member since {{ date('F, Y',strtotime(Auth::user()->created_at)) }}</small>
              </p>
            </li>
            <!--end::Menu Body-->
            <!--begin::Menu Footer-->
            <li class="user-footer">
              <a href="{{ route('admin.edituser',Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
              <a href="#" class="btn btn-default btn-flat float-end logout_btn" id="logout_btn">Sign out</a>
            </li>
            <!--end::Menu Footer-->
          </ul>
        </li>
        <!--end::User Menu Dropdown-->
      </ul>
      <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
  </nav>
  <!--end::Header-->
  <!--begin::Sidebar-->
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <!--begin::Brand Image-->
        <div><img
          src="{{ url('public/assets/frontend/img/'. $settings['footer_logo']) }}"
          alt="{{ $settings['website_name'] }}"
          class="brand-image opacity-75 shadow"
        /></div>
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
              <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'menu-open' : '' }}">
                  <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                      <i class="nav-icon bi bi-speedometer"></i>
                      <p>Dashboard</p>
                  </a>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.mainslider', 'admin.editmainslider', 'admin.settings','admin.mainslider','admin.createmainslider','admin.editmainslider') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-gear"></i>
                      <p>
                          Settings
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.mainslider') }}" class="nav-link {{ request()->routeIs('admin.mainslider', 'admin.editmainslider') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Home Slider</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Settings</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.pages', 'admin.createpage', 'admin.editpage') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-pencil-square"></i>
                      <p>
                          Pages
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.pages') }}" class="nav-link {{ request()->routeIs('admin.pages') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Page List</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.createpage') }}" class="nav-link {{ request()->routeIs('admin.createpage') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Add Page</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.blogs', 'admin.createblog', 'admin.editblog') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-pencil-square"></i>
                      <p>
                          Blogs
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.blogs') }}" class="nav-link {{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Blog List</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.createblog') }}" class="nav-link {{ request()->routeIs('admin.createblog') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Add Blog</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.events', 'admin.createevent', 'admin.editevent','admin.events.items','admin.createevent.items','admin.editevent.items') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-pencil-square"></i>
                      <p>
                          Galleries
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.events') }}" class="nav-link {{ request()->routeIs('admin.events','admin.createevent', 'admin.editevent') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Gallery List</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.events.items') }}" class="nav-link {{ request()->routeIs('admin.events.items','admin.createevent.items','admin.editevent.items') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Gallery Items</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.products', 'admin.createproduct', 'admin.editproduct','admin.products.items','admin.createproduct.items','admin.editproduct.items') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-pencil-square"></i>
                      <p>
                          Products
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.products') }}" class="nav-link {{ request()->routeIs('admin.products','admin.createproduct', 'admin.editproduct') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Products List</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.createproduct') }}" class="nav-link {{ request()->routeIs('admin.createproduct') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Add Products</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.orders', 'admin.createorder', 'admin.editorder') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-pencil-square"></i>
                      <p>
                          Orders
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->routeIs('admin.orders','admin.createproduct', 'admin.editproduct') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Orders List</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.createorder') }}" class="nav-link {{ request()->routeIs('admin.createorder') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Add Order</p>
                          </a>
                      </li>
                  </ul>
              </li>
{{--
              <li class="nav-item {{ request()->routeIs('admin.galleryhome', 'admin.editgalleryhome', 'admin.addgalleryhome') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-image"></i>
                      <p>
                          Galleries
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.galleryhome') }}" class="nav-link {{ request()->routeIs('admin.galleryhome') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Galleries List</p>
                          </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('admin.addgalleryhome') }}" class="nav-link {{ request()->routeIs('admin.galleryhome') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Add Gallery</p>
                          </a>
                      </li>
                  </ul>
              </li> --}}

              <li class="nav-item {{ request()->routeIs('admin.users', 'admin.adduser', 'admin.edituser') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-person-fill"></i>
                      <p>
                          Users
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>User List</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.adduser') }}" class="nav-link {{ request()->routeIs('admin.adduser') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Add User</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.customers', 'admin.addcustomer', 'admin.editcustomer') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-person-fill"></i>
                      <p>
                          Customers
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.customers') }}" class="nav-link {{ request()->routeIs('admin.customers') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Customer List</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.addcustomer') }}" class="nav-link {{ request()->routeIs('admin.addcustomer') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Add Customer</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.homesecvideo','admin.homesecaccording','admin.homesecpartners','admin.createhomesecaccording','admin.edithomesecaccording','admin.createhomesecpartners','admin.edithomesecpartners','admin.edithomesecvideo') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-home"></i>
                      <p>
                          Home Section
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      {{-- <li class="nav-item">
                          <a href="{{ route('admin.homesecvideo',34) }}" class="nav-link {{ request()->routeIs('admin.homesecvideo','admin.edithomesecvideo') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Home Section Video</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.homesecaccording') }}" class="nav-link {{ request()->routeIs('admin.homesecaccording','admin.edithomesecaccording','admin.createhomesecaccording') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Home Section According</p>
                          </a>
                      </li> --}}
                      <li class="nav-item">
                          <a href="{{ route('admin.homesecpartners') }}" class="nav-link {{ request()->routeIs('admin.homesecpartners','admin.createhomesecpartners','admin.edithomesecpartners') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Partners</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.contacts', 'admin.editcontact', 'admin.viewcontact') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-people"></i>
                      <p>
                          Contact Details
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.contacts') }}" class="nav-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Contact List</p>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.uploads', 'admin.createupload', 'admin.editupload') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-image"></i>
                      <p>
                          Media
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.uploads') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Upload File</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.createupload') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Add File</p>
                          </a>
                      </li>
                  </ul>
              </li>


              <li class="nav-item logout-btn-item logout_btn">
                  <a href="#" class="nav-link logout-btn">
                      <i class="nav-icon bi bi-x-circle"></i>
                      <p>
                          Logout
                      </p>
                  </a>
              </li>

          </ul>
      </nav>
  </div>

    <!--end::Sidebar Wrapper-->
  </aside>
