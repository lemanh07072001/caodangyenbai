
<div class="modal fade" id="addListPost" data-id="{{$getFind->id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Thêm sản phẩm vào nhóm: <span id="titleListGroup">{{$getFind->title}}</span></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div id="example1_filter" class="dataTables_filter">
                        <input type="search"
                               class="form-control form-control-sm"
                               placeholder="Nhập từ khóa tìm kiếm..."
                               id="liveSearchInput"
                               aria-controls="example1">
        
                    <table id="dataTabless" class="table mt-2 mb-2 table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Hình ảnh</th>
                                <th>Tên tin tức</th>
                                <th width="15%">Danh mục</th>
                                <th width="10%">Người tạo</th>
                                <th width="10%">Ngày tạo</th>
                                <th width="15%">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@push('js')
  <script>
      $(document).ready(function () {
  
          const url = '{!! route('groupPost.listPostData') !!}';
  
          const columns = [
            { data: 'thumbnail'},
              { data: 'title'},
              { data: 'addPost'},
              { data: 'user_id' },
              { data: 'date'},
              { data: 'work'},
          ];
  
  
          const _CUSTOM_DATATABLES = {
              CLASS_ROW : '',
              PAGE : '5',
              TARGETS : [1,2,3,4,5]
              
          }
          var dataTableIndex = initializeDataTable(url,columns,_CUSTOM_DATATABLES,'dataTabless');
  
          /* Change Categories Status */
          $(document).on('click','.addListPost',function () {
             
              var ID = $(this).closest('tr').attr('id');

              const idListGroup = $('#addListPost').attr('data-id');

              $.ajax({
                url : '/admin/groupPost/add_list_post_data',
                type : 'post',
                data : {
                    id : ID,
                    idListGroup : idListGroup
                },
                success: function (response) {
                  
                  if(response.status === 200){
                    alertOption(response.message);
                  }else if(response.status === 500){
                    alertOption(response.message);
                  }
                    dataTableIndex.ajax.reload();
                }

            })
              
  
              
          })
  
          /* Destroy Ajax */
          const urlDestroy = 'admin/groupPost/destroy'
          ajaxDestroy(urlDestroy,dataTableIndex,'toast')
  
          /* Update Status Ajax */
          const urlUpdateStatus = 'admin/groupPost/changeStatus';
          ajaxUpdateStatus(urlUpdateStatus,dataTableIndex)
  
          /* Get title Ajax */
          const module = 'groupPost';
          ajaxUpdateTitle(module,'nhóm tin tức',dataTableIndex)
         
      })
  </script>
@endpush