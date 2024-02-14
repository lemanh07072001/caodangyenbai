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

      <li class="nav-header">QUẢN LÝ DANH MỤC</li>

      {{--  Banenr  --}}
      <li class="nav-item ">
        <a href="{{route('categories.index')}}" class="nav-link {{request()->routeIs('categories.*')?'active':''}}">
          <i class="nav-icon fas fa-th-list"></i>
          <p>
            Danh sách danh mục
          </p>
        </a>
      </li>
     

       {{--  Banenr  --}}
       <li class="nav-item ">
        <a href="{{route('banner.index')}}" class="nav-link {{request()->routeIs('banner.*')?'active':''}}">
          <i class="nav-icon fas fa-sliders-h"></i>
          <p>
            Danh sách Banner
          </p>
        </a>
      </li>

      {{--  Slide  --}}
      <li class="nav-item ">
        <a href="{{route('slide.index')}}" class="nav-link {{request()->routeIs('slide.*')?'active':''}}">
          <i class="nav-icon fas fa-ticket-alt"></i>
          <p>
            Danh sách Slide
          </p>
        </a>
      </li>

      <li class="nav-header">QUẢN LÝ TIN TỨC</li>

      {{--  Post  --}}
      <li class="nav-item ">
        <a href="{{route('post.index')}}" class="nav-link {{request()->routeIs('post.*')?'active':''}}">
          <i class="nav-icon fas fa-newspaper"></i>
          <p>
            Danh sách tin tức
          </p>
        </a>
      </li>

      {{--  groupPost  --}}
      <li class="nav-item ">
        <a href="{{route('groupPost.index')}}" class="nav-link {{request()->routeIs('groupPost.*')?'active':''}}">
          <i class="nav-icon fas fa-plus-square"></i>
          <p>
            Danh sách nhóm tin tức
          </p>
        </a>
      </li>
    </ul>
  </nav>
