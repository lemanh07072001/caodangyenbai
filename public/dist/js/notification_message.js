function notificationAlert(data) {
    if (data.status === 200) {
        Swal.fire({
            title: "Thành công!",
            text: data.message,
            icon: "success",
        });
    } else {
        Swal.fire({
            title: "Thất bại!",
            text: data.message,
            icon: "error",
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
        },
    });

    if (data.status === 200) {
        this.alertOption(data.message);
    } else {
        this.alertOption(data.message, "error");
    }
}

function alertOption(message, type = "success") {
    if (typeof toastr === "undefined") {
        console.error("Toastr library is not loaded.");
        return;
    }

    switch (type) {
        case "info":
            toastr["info"](message);
            break;
        case "warning":
            toastr["warning"](message);
            break;
        case "error":
            toastr["error"](message);
            break;
        default:
            toastr["success"](message);
    }
}
