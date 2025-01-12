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
    
});


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