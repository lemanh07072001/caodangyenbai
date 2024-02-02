$(document).ready(function () {
    // Action
    previewImage();

    // Bắt sự kiện khi checkbox thay đổi trạng thái
    $("#btnStatus").change(function () {
        if ($(this).prop("checked")) {
            $("#status").html("Kích hoạt");
        } else {
            $("#status").html("Không kích hoạt");
        }
    });

    // Bắt sự kiện click chọn ảnh
    const chooseFile = $(".chooseFile");
    if (chooseFile !== undefined) {
        chooseFile.each(function (index, item) {
            $(item).click(function () {
                const ckfindGroup = $(this).closest(".ckfind-group");

                //Code mở popup Ckfinder
                CKFinder.popup({
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function (finder) {
                        finder.on("files:choose", function (evt) {
                            let fileUrl = evt.data.files.first().getUrl();
                            //Xử lý chèn link ảnh vào input
                            const imageRender =
                                ckfindGroup.find(".image-render");
                            imageRender.val(fileUrl);

                            // Chèn ảnh vảo box
                            previewImage(fileUrl);
                        });
                        finder.on("file:choose:resizedImage", function (evt) {
                            let fileUrl = evt.data.resizedUrl;
                            //Xử lý chèn link ảnh vào input
                            const imageRender =
                                ckfindGroup.find(".image-render");
                            imageRender.val(fileUrl);
                        });
                    },
                });
            });
        });
    }

    // Preview Image
    function previewImage(data) {
        let url = $(".image-render").attr("value");

        if (data) {
            renderImage(data);
            $("#previewImage").html(renderImage(data));
        } else {
            renderImage(url);
            $("#previewImage").html(renderImage(url));
        }
    }

    $(document).on("click", ".imgPre", function (e) {
        let url = $(this).attr("src");
        var fileType = getFileType(url);
        if (fileType === "image") {
            Swal.fire({
                imageUrl: url,
                imageWidth: 400,
                imageHeight: 200,
            });
        }
    });
});

function renderImage(data) {
    var fileType = getFileType(data);

    let html = "";
    if (fileType === "image") {
        html += '<img class="imgPre" src="' + data + '" alt="" height="90px"/>';
    } else if (fileType === "video") {
        html +=
            '<video class="imgPre" controls autoplay loop height="90px"><source src="' +
            data +
            '" type="video/mp4" /></video>';
    }
    return html;
}

function getFileType(filePath) {
    if (filePath !== undefined) {
        var extension = filePath.split(".").pop().toLowerCase();

        if (["jpg", "jpeg", "png", "gif"].indexOf(extension) !== -1) {
            return "image";
        } else if (["mp4", "webm", "avi", "mkv"].indexOf(extension) !== -1) {
            return "video";
        } else {
            return false;
        }
    }

    return false;
}
