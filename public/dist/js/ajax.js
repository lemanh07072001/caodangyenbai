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

// Function Update Title Ajax

function ajaxUpdateTitle(url, title = "Title", dataTableIndex) {
    $(document).on("click", ".btnInputEdit", async function (e) {
        try {
            var ID = $(this).closest("tr").attr("id");
            const currentData = await getCurrentData(url, ID);
            Swal.fire({
                title: `Cập nhật tên ${title} `,
                input: "text",
                inputLabel: "Vui lòng nhập dữ liệu cập nhập",
                inputValue: currentData.data.title,
                inputAttributes: {
                    autocapitalize: "off",
                },
                showCancelButton: true,
                confirmButtonText: "Xác nhận",
                showLoaderOnConfirm: true,
                preConfirm: async (value) => {
                    try {
                        const response = await updateData(url, ID, value);

                        if (response.errors) {
                            Swal.showValidationMessage(`
                                  ${response.errors.title}
                                `);
                        }

                        if (response.success) {
                            dataTableIndex.ajax.reload();
                            return alertOption(response.success);
                        }
                    } catch (error) {
                        Swal.showValidationMessage(`
                      Request failed: ${error}
                    `);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading(),
            });
        } catch (error) {
            console.error("Error:", error);
        }
    });

    async function getCurrentData(url, ID) {
        try {
            const response = await $.ajax({
                url: "/admin/" + url + "/getTitle/" + ID,
                type: "GET",
            });

            return response;
        } catch (error) {
            throw new Error(
                "Failed to fetch current data: " + error.statusText
            );
        }
    }

    async function updateData(url, ID, data) {
        try {
            const response = await $.ajax({
                url: "/admin/" + url + "/updateTitle/" + ID,
                type: "POST",
                data: { title: data },
                dataType: "json", // Adjust accordingly
            });

            return response;
        } catch (error) {
            throw new Error("Failed to update data: " + error.statusText);
        }
    }
}
