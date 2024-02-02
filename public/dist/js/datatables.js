function initializeDataTable(url, arrayColumns, custom = {}) {
    const liveStatusSelect = $("#liveStatusSelect");
    const liveSearchInput = $("#liveSearchInput");
    const liveUserSelect = $("#liveUserSelect");

    var datatables = $("#dataTables").DataTable({
        ajax: {
            url: url,
            data: function (data) {
                data.searchInput = liveSearchInput.val();
                data.statusSelect = liveStatusSelect.val();
                data.searchUser = liveUserSelect.val();
            },
        },
        deferRender: true,
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        pagingType: "first_last_numbers",
        order: [[0, orderIndex]],
        columnDefs: [
            {
                orderable: false,
                targets: custom.TARGETS,
            },
            // Tắt xắp xếp cho cột 0, 1, và 2
        ],
        rowId: "id",
        /* select: {
             style: 'multi'
         },*/
        rowCallback: function (row, data, index) {
            // Thay đổi độ cao của hàng thành 50px (hoặc bất kỳ giá trị nào bạn muốn)
            $(row).css({
                height: custom.CLASS_ROW,
                position: "relative",
            });
        },

        language: language,
        processing: true,
        serverSide: true,
        pageLength: custom.PAGE,
        columns: arrayColumns,
    });

    /* Live Search */
    if (liveSearchInput !== undefined) {
        liveSearchInput.on("keyup", function () {
            datatables.ajax.reload();
        });
    }

    /* Live Status */
    if (liveStatusSelect !== undefined) {
        liveStatusSelect.on("change", function () {
            datatables.ajax.reload();
        });
    }

    /* Search User Live */
    if (liveUserSelect !== undefined) {
        liveUserSelect.on("change", function () {
            datatables.ajax.reload();
        });
    }

    return datatables;

    /* dataTableIndex.on('select deselect', function (e, dt, type, indexes) {
         var selectedRows = dt.rows({ selected: true }).count();
         $('#countRow').html(selectedRows)

     });
*/
}
