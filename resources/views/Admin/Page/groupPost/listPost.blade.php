{{--  Layout  --}}
@extends('Admin.LayoutAdmin.layout')

{{--  Title  --}}
@section('title','Danh sách tin tức trong nhóm ')

{{--  Breadcrumbs  --}}
@section('breadcrumbs')
{{ Breadcrumbs::render('groupPostListPost',$getFind->id) }}
@endsection

{{--  Content  --}}
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{$getFind->title}}</strong>
                    <small class="d-block textdate">Ngày tạo : {{$getFind->created_at}}</small>
                </div>
                <div>
                    <button class="btn btn-info btn-sm "  data-toggle="modal" data-target="#addListPost"><i class="fas fa-plus"></i> Thêm tin tức</button>
                </div>
            </div>
        </div>
        <div class="footer p-2">
            <div class="d-flex justify-content-between align-items-center">
                <small class="count ">Số lượng tin tức trong nhóm: <span id="countPost">{{$countPost}}</span></small>
                
            </div>
        </div>
      </div>
      <!-- /.card -->
    </div>

    <div class="col-12">
       
        <div class="card">
          <div class="p-2">
            <input type="hidden" class="inputHiden" value="{{$getFind->id}}"/>
            <h5>Danh sách tin tức trong nhóm</h5>
            <table id="dataTablesss" class="table  table-hover">
                <thead>
                <tr>
                    <th width="15%">Hình ảnh</th>
                    <th>Tên tin tức</th>
                    <th width="15%">Danh mục</th>
                    <th width="10%">Người tạo</th>
                    <th width="10%">Ngày tạo</th>
                    <th width="10%">Hoạt động</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
          </div>
          
        </div>
        <!-- /.card -->
      </div>
    <!-- /.col -->
  </div>    
  @include('Admin.Page.groupPost.addListPost',['getFind' => $getFind])

@endsection

@push('js')
  <script>
      $(document).ready(function () {
  
          const url = '{!! route('groupPost.getListPost',$getFind->id) !!}';
  
          const columns = [
            { data: 'thumbnail'},
              { data: 'title'},
              { data: 'categories_id'},
              { data: 'user_id' },
              { data: 'date'},
              { data: 'work'},
          ];
  
  
          const _CUSTOM_DATATABLES = {
              CLASS_ROW : '',
              PAGE : '4',
              TARGETS : [1,2,3,4,5]
              
          }
          var dataTableIndex = initializeDataTable(url,columns,_CUSTOM_DATATABLES,'dataTablesss');
  

  
          /* Destroy Ajax */
          $(document).on('click','.btnDestroy',function(e) {
              var ID = $(this).closest("tr").attr("id");
              const idListGroup = $('.inputHiden').val();
           
              $.ajax({
                url: "/admin/groupPost/destroy_list_post/" + ID,
                type: "delete",
                data: {
                    id: ID,
                    idListGroup : idListGroup
                },
                success: function (response) {
                    toastr.success(response.message);
                    dataTableIndex.ajax.reload(function () {}, false);
                },
            });
          })

          /* Update Status Ajax */
          const urlUpdateStatus = 'admin/groupPost/changeStatus';
          ajaxUpdateStatus(urlUpdateStatus,dataTableIndex)
  
          /* Get title Ajax */
          const module = 'groupPost';
          ajaxUpdateTitle(module,'nhóm tin tức',dataTableIndex)
         
      })
  </script>
@endpush
