function notificationAlert (data) {
    if(data.status === 200){
        Swal.fire({
            title: "Thành công!",
            text: data.message,
            icon: "success"
        });
    }else{
        Swal.fire({
            title: "Thất bại!",
            text: data.message,
            icon: "error"
        });
    }
}

function notificationToast(data) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    if(data.status === 200){
        Toast.fire({
            icon: "success",
            title: data.message,
        });
    }else{
        Toast.fire({
            icon: "error",
            title: data.message,
        });
    }
}
