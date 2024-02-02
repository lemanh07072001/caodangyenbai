{{--  Layout  --}}
@extends('Admin.LayoutAdmin.layout')

{{--  Title  --}}
@section('title','Danh sách Banner')

{{--  Breadcrumbs  --}}
@section('breadcrumbs')
{{ Breadcrumbs::render('Banner') }}
@endsection

{{--  Content  --}}
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-2 ">
                    <a href="{{route('banner.create')}}" class="btn btn-success btn-block btn-sm">Thêm dữ liệu</a>
                </div>
                <div class="col-lg-2 mt-sm-2 mt-2 mt-lg-0">
                    <select class="form-control form-control-sm" id="liveStatusSelect">
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="0">Kích hoạt</option>
                        <option value="1">Không kích hoạt</option>
                    </select>
                </div>
                <div class="col-lg-2 mt-sm-2 mt-2 mt-lg-0">
                  <select class="form-control form-control-sm" id="liveUserSelect">
                      <option value="">-- Chọn người đăng --</option>
                      @if(!empty($getUser))
                        @foreach($getUser as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      @endif
                  </select>
              </div>
                <div class="col-lg-6 mt-sm-2 mt-2 mt-lg-0">
                    <div id="example1_filter" class="dataTables_filter">
                        <input type="search"
                               class="form-control form-control-sm"
                               placeholder="Nhập từ khóa tìm kiếm..."
                               id="liveSearchInput"
                               aria-controls="example1">
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body pl-0 pr-0">
          <table id="dataTables" class="table  table-hover">
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="15%">Hình ảnh/Video</th>
                <th>Tên Banner</th>
                <th width="15%">Danh mục/Link</th>
                <th width="10%">Người tạo</th>
                <th width="10%">Trạng thái</th>
                <th width="10%">Type</th>
                <th width="10%">Thời gian</th>
                <th width="10%">Hoạt động</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
@endsection

@push('js')
<script>
    $(document).ready(function () {

        const url = '{!! route('banner.getData') !!}';

        const columns = [
            { data: 'id'},
            { data: 'thumbnail'},
            { data: 'title'},
            { data: 'link_action'},
            { data: 'user_id' },
            { data: 'type' },
            { data: 'status'},
            { data: 'format_date'},
            { data: 'work'},
        ];


        const _CUSTOM_DATATABLES = {
            CLASS_ROW : '',
            PAGE : '5',
            TARGETS : [1,2,3,4,5,6,7,8]
            
        }
        var dataTableIndex = initializeDataTable(url,columns,_CUSTOM_DATATABLES);

        /* Destroy Ajax */
        const urlDestroy = 'admin/banner/destroy'
        ajaxDestroy(urlDestroy,dataTableIndex,'toast')

        /* Update Status Ajax */
        const urlUpdateStatus = 'admin/banner/changeStatus';
        ajaxUpdateStatus(urlUpdateStatus,dataTableIndex)

       
    })
</script>
@endpush
