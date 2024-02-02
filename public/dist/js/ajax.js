$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// Function Destroy Ajax
function ajaxDestroy(url, dataTableIndex, type = "toast ") {
    $(document).on("click", ".btnDelete", function () {
        var ID = $(this).closest("tr").attr("id");
        console.log(ID);
        Swal.fire({
            title: "Bạn có chắc muốn xóa?",
            text: "Xóa không thể khôi phục lại!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có, Tôi đồng ý!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/" + url + "/" + ID,
                    type: "DELETE",
                    success: function (data) {
                        if (type === "toast") {
                            alertOption(data.message);
                        } else if (type === "alert") {
                            notificationAlert(data);
                        }

                        dataTableIndex.ajax.reload(function () {}, false);
                    },
                });
            }
        });
    });
}

// Function Update Status Ajax
function ajaxUpdateStatus(url, dataTableIndex) {
    $(document).on("click", ".statusSelect", function () {
        var statusValue = "";

        if ($(this).prop("checked")) {
            statusValue = 0;
        } else {
            statusValue = 1;
        }

        var ID = $(this).closest("tr").attr("id");

        $.ajax({
            url: "/" + url + "/" + ID,
            type: "post",
            data: {
                id: ID,
                value: statusValue,
            },
            success: function (response) {
                toastr.success(response.message);
                dataTableIndex.ajax.reload(function () {}, false);
            },
        });
    });
}
