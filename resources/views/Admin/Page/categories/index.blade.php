{{--  Layout  --}}
@extends('Admin.LayoutAdmin.layout')

{{--  Title  --}}
@section('title','Danh sách danh mục')

{{--  Breadcrumbs  --}}
@section('breadcrumbs')
{{ Breadcrumbs::render('Categories') }}
@endsection

{{--  Content  --}}
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-2 ">
                    <a href="{{route('categories.create')}}" class="btn btn-success btn-block btn-sm">Thêm dữ liệu</a>
                </div>
                <div class="col-lg-2 mt-sm-2 mt-2 mt-lg-0">
                    <select class="form-control form-control-sm" id="liveStatusSelect">
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="0">Kích hoạt</option>
                        <option value="1">Không kích hoạt</option>
                    </select>
                </div>
                <div class="col-lg-8 mt-sm-2 mt-2 mt-lg-0">
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
                <th>Tên danh mục</th>
                <th width="15%">Danh mục</th>

                <th width="10%">Trạng thái</th>
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

        const url = '{!! route('categories.getData') !!}';

        const columns = [
            { data: 'id'},
            { data: 'title' },
            { data: 'parent_name' },
            { data: 'status'},
            { data: 'format_date'},
            { data: 'work'},
        ];


        const _CUSTOM_DATATABLES = {
            CLASS_ROW : '',
            PAGE : '1'
        }
        var dataTableIndex = initializeDataTable(url,columns,_CUSTOM_DATATABLES);

        /* Change Categories Status */
        $(document).on('change','.changeCategories',function () {
            var selectedValue = $(this).val();
            var ID = $(this).closest('tr').attr('id');

            $.ajax({
                url : '/admin/categories/changeCategories/'+ID,
                type : 'post',
                data : {
                    id : ID,
                    value : selectedValue
                },
                success: function (response) {
                    dataTableIndex.ajax.reload(function(){}, false);
                }

            })
        })

        /* Destroy Ajax */
        const urlDestroy = 'admin/categories/destroy'
        ajaxDestroy(urlDestroy,dataTableIndex,'alert')

        /* Update Status Ajax */
        const urlUpdateStatus = 'admin/categories/changeStatus';
        ajaxUpdateStatus(urlUpdateStatus,dataTableIndex)
    })
</script>
@endpush
