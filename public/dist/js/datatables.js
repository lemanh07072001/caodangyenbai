function initializeDataTable(url,arrayColumns,custom={}) {
    const liveStatusSelect = $('#liveStatusSelect');
    const liveSearchInput = $('#liveSearchInput')


    var datatables = $('#dataTables').DataTable({
        ajax: {
            url : url,
            data : function (data) {
                data.searchInput  = liveSearchInput.val();
                data.statusSelect = liveStatusSelect.val();
            }
        },
        deferRender: true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "pagingType": "first_last_numbers",
        "order": [[0, orderIndex]],
        "columnDefs": [
            {
                "orderable": false,
                "targets": [1,2,3,4,5]
            } ,
            // Tắt xắp xếp cho cột 0, 1, và 2
        ],
        "rowId": "id",
        /* select: {
             style: 'multi'
         },*/
        rowCallback: function(row, data, index) {
            // Thay đổi độ cao của hàng thành 50px (hoặc bất kỳ giá trị nào bạn muốn)
            $(row).css({
                'height': custom.CLASS_ROW,
                'position' : 'relative'
            });
        },

        language: language,
        processing: true,
        serverSide: true,
        pageLength :custom.PAGE,
        columns: arrayColumns
    });

    /* Live Search */
    liveSearchInput.on('keyup', function () {
        datatables.ajax.reload();
    });

    /* Live Status */
    liveStatusSelect.on('change',function () {
        datatables.ajax.reload();
    })


    return datatables;


    /* dataTableIndex.on('select deselect', function (e, dt, type, indexes) {
         var selectedRows = dt.rows({ selected: true }).count();
         $('#countRow').html(selectedRows)

     });
*/

}
