<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Payment</title>
</head>
<body>
    <h1>Mã QR Thanh Toán</h1>
    <p>Quét mã QR để thực hiện thanh toán</p>
    <p>Nội dung chuyển khoản vui long nhập theo hướng dẫn :<strong>{{ $orderId }}</strong></p>
    <div>
        <img src="{!! $qrCodeUrl !!}" alt="QR Code">
    </div>
</body>
</html>
