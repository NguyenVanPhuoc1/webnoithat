$(document).ready(function () {
    // Khi nút "Xóa Tất Cả" được nhấn
    $('#delete-all').click(function () {
        // Hiển thị modal thông báo
        $('#confirmationModal').modal('show');
    });

    // Khi nút "Yes" trong modal được nhấn
    $('#confirmDelete').click(function () {
        // Thực hiện hành động xóa tất cả dữ liệu ở đây (điều này cần được cài đặt)

        // Đóng modal
        $('#confirmationModal').modal('hide');
    });
});

$(document).ready(function () {
    // Khi nút "Xóa Tất Cả" được nhấn
    $('#send-all').click(function () {
        // Hiển thị modal thông báo
        $('#confirmationModalsend').modal('show');
    });

    // Khi nút "Yes" trong modal được nhấn
    $('#confirmSend').click(function () {
        // Thực hiện hành động xóa tất cả dữ liệu ở đây (điều này cần được cài đặt)

        // Đóng modal
        $('#confirmationModalsend').modal('hide');
    });
});