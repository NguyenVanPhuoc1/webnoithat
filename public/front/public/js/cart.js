$(document).ready(function(){
    
    var productContainer = $('.procart-list');
    productContainer.on('click', '.quantity-minus-pro-detail, .quantity-plus-pro-detail', function (event) {
        // Lấy hàng sản phẩm chứa nút đã click
        var productRow = $(this).closest('tr');
        
        // Lấy số lượng hiện tại của sản phẩm
        var qtyInput = productRow.find('.quantity-pro-detail .qty-pro');
        var currentValue = parseInt(qtyInput.val());

        if ($(this).hasClass('quantity-minus-pro-detail')) {
            // Giảm số lượng nếu giá trị hiện tại lớn hơn 1
            if (currentValue > 1) {
                qtyInput.val(currentValue - 1);
            }
        } else if ($(this).hasClass('quantity-plus-pro-detail')) {
            // Tăng số lượng khi nút cộng được click
            qtyInput.val(currentValue + 1);
        }
        
        updateCart($(this));
    });
    
    document.getElementById('thanhtoan').addEventListener('click', function(event){
        var totalPriceValue = document.getElementById('totalPrice').innerText.trim();
        // Loại bỏ tất cả các ký tự không mong muốn từ chuỗi
        var totalPriceCleaned = totalPriceValue.replace(/[^\d,.]/g, '');
            
        // Chuyển đổi chuỗi thành số
        totalPriceValue = parseFloat(totalPriceCleaned.replace(/,/g, ''));

        
        // Thêm thẻ input vào form
        var totalPriceInput = document.createElement('input');
        totalPriceInput.type = 'hidden';
        totalPriceInput.name = 'totalPrice';
        totalPriceInput.value = totalPriceValue;

        var storedTotalPrice = parseFloat(localStorage.getItem('total_update'));
        console.log(data_totalPrice);
        console.log(storedTotalPrice);
        
        if(parseFloat(totalPriceInput.value) === data_totalPrice || storedTotalPrice === parseFloat(totalPriceInput.value) ){
            document.getElementById('paymentForm').appendChild(totalPriceInput);
        }else{
            alert('Giá trị của giỏ hàng đã thay đổi, vui lòng kiểm tra lại trước khi thanh toán.');
            event.preventDefault();
            // window.location.reload();
        }
    });
    
});


// Xử lý sự kiện khi thay đổi số lượng trực tiếp trên input
// $('.quantity-pro-detail .qty-pro').on('change', function() {
//     // Gửi AJAX để cập nhật giỏ hàng
//     updateCart($(this));
// });

function updateCart(element) {
    // cập nhật thông tin sản phẩm trong giỏ hàng
    var formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        currencyDisplay: 'symbol'
    });
    var rowId = element.closest('tr').data('row-id');
    var quantity = element.closest('tr').find('.quantity-pro-detail .qty-pro').val();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/gio-hang/update/' + rowId,
        method: 'PATCH',
        data: {
            quantity: quantity,
            _token: csrfToken
        },
        success: function(data) {
            // Cập nhật giá tiền và tổng giá tiền trên giao diện
            var productRow = element.closest('tr');
            productRow.find('.text-price').text(formatter.format(data.subtotal).replace('.', ','));
            $('.totalPrice').text(formatter.format(data.totalPrice).replace('.', ','));
            document.getElementsByName('totalPrice').innerText = data.totalPrice;
            localStorage.setItem('total_update', data.totalPrice);
            // console.log(document.getElementsByName('totalPrice').innerText);
            
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}

function deleteProduct(event){
    event.preventDefault();
    var formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        currencyDisplay: 'symbol'
    });
    var rowId = $(event.target).closest('tr').data('row-id');
    if (confirm("Bạn có muốn xóa sản phẩm này không?")) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/gio-hang/delete/' + rowId,
            type: 'DELETE',
            data: {
                _token: csrfToken,
            },
            success: function(response) {
                if (response.success) {
                    // Xóa sản phẩm khỏi DOM nếu xóa thành công
                    $(event.target).closest('tr').remove();
                    if(response.totalPrice > 0){
                        // Hiển thị thông báo hoặc thực hiện các thao tác khác nếu 
                        $('.totalPrice').text(formatter.format(response.totalPrice).replace('.', ','));
                        localStorage.setItem('total_update', response.totalPrice);
                        alert('Sản phẩm đã được xóa khỏi giỏ hàng.');
                    }
                    else
                    {
                        window.location.reload();
                    }
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
}