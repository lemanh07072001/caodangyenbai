$(document).ready(function () {
    // Bắt sự kiện khi checkbox thay đổi trạng thái
    $('#btnStatus').change(function () {
        if ($(this).prop("checked")){
            $('#status').html('Kích hoạt')
        }else{
            $('#status').html('Không kích hoạt')
        }
    })
})

