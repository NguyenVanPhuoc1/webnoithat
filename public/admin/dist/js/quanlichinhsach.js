$(document).ready(function() {
    // Mảng để lưu các id của các phần tử được chọn
    let selectedIds = [];

    // Lắng nghe sự kiện khi checkbox "Chọn tất cả" thay đổi
    $('#selectall-checkboxchinhsach').on('change', function() {
        // Kiểm tra nếu checkbox "Chọn tất cả" được chọn hay không
        let isChecked = $(this).prop('checked');
        
        // Chọn hoặc bỏ chọn tất cả các checkbox con
        $('.select-checkbox').prop('checked', isChecked);

        // Cập nhật mảng selectedIds
        if (isChecked) {
            // Thêm tất cả các id vào mảng
            selectedIds = $('.select-checkbox').map(function() {
                return $(this).val();
            }).get();
        } else {
            // Nếu không chọn tất cả, xóa mảng selectedIds
            selectedIds = [];
        }

        // console.log(selectedSlugs);  // In ra mảng id đã chọn
    });

    // Lắng nghe sự kiện khi bất kỳ checkbox nào thay đổi (khi chọn hoặc bỏ chọn checkbox đơn lẻ)
    $(document).on('change', '.select-checkbox', function() {
        // Lấy id của checkbox đang thay đổi
        let checkboxId = $(this).val();

        // Kiểm tra nếu checkbox này được chọn hay không
        if ($(this).prop('checked')) {
            // Nếu chọn, thêm id vào mảng selectedIds
            selectedIds.push(checkboxId);
        } else {
            // Nếu bỏ chọn, xóa id khỏi mảng selectedIds
            selectedIds = selectedIds.filter(id => id !== checkboxId);
        }

        // console.log(selectedSlugs);  // In ra mảng id đã chọn
    });
    // Đặt sự kiện khi nút "Xóa tất cả" được nhấp
    $('#confirmDelete').click(function(e) {
        e.preventDefault();
        // alert(selectedSlugs);
        // Kiểm tra xem có ít nhất một checkbox nào đó được chọn không
        if (selectedIds.length === 0) {
            alert('Vui lòng chọn ít nhất một bài viết để xóa.');
            return;
        }else{
            $.ajax({
                url: '/admin/quanlibaiviet/chinhsach/delete',  
                type: 'DELETE',
                data: {
                    _token: $('input[name="_token"]').val(),  // CSRF token để bảo vệ request
                    selectedIds: selectedIds  // Mảng slug cần xóa
                },
                success: function(response) {
                    // console.log(response);
                    toastr.success("Xóa Thành Công");  // Hiển thị thông báo thành công
                    // location.reload();  // Reload lại trang nếu cần
                },
                error: function(xhr) {
                    console.log('Có lỗi xảy ra: ' + xhr.responseJSON.error);  // Hiển thị lỗi nếu có
                }
            });
        }
    
    });
    function performSearchNews() {
        var keyword = document.getElementById('keyword').value;
    
        // Kiểm tra xem trường nhập liệu có giá trị không
        if (keyword.trim() === "") {
            // Nếu không có giá trị, hiển thị lỗi
            document.getElementById('searchError').style.setProperty('display', 'block', 'important');
            return;
        }
    
        // Nếu có giá trị, gửi form
        document.getElementById('poli_search').submit();
    }
    document.getElementById('search-button').addEventListener('click', function(event) {
        event.preventDefault(); 
        performSearchNews()
    });
    document.getElementById('poli_search').addEventListener('submit', function(event) {
        event.preventDefault(); 
        performSearchNews()
    });
    
});





// hàm tìm kiếm khi click vào button tìm kiếm