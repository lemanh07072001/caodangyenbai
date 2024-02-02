<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      {{--  Dashboard  --}}
      <li class="nav-item ">
        <a href="#" class="nav-link {{request()->routeIs('dashboard.*')?'active':''}}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="pages/widgets.html" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Widgets
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>

      <li class="nav-header">QUẢN LÝ</li>


      <li class="nav-item {{request()->routeIs('categories.*')?'menu-open':''}}">
        <a href="#" class="nav-link {{request()->routeIs('categories.*')?'active':''}}">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Danh mục
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link {{request()->routeIs('categories.*')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Danh sách danh mục</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Top Navigation + Sidebar</p>
            </a>
          </li>

        </ul>
      </li>

       {{--  Banenr  --}}
       <li class="nav-item ">
        <a href="{{route('banner.index')}}" class="nav-link {{request()->routeIs('banner.*')?'active':''}}">
          <i class="nav-icon fas fa-sliders-h"></i>
          <p>
            Banner
          </p>
        </a>
      </li>

      {{--  Slide  --}}
      <li class="nav-item ">
        <a href="{{route('slide.index')}}" class="nav-link {{request()->routeIs('slide.*')?'active':''}}">
          <i class="nav-icon fas fa-sliders-h"></i>
          <p>
            Slide
          </p>
        </a>
      </li>

    </ul>
  </nav>
