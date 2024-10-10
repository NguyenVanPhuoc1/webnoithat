require('./bootstrap');

window.Echo.channel('admin-notifications')
    .listen('UserRegistered', (event) => {
        console.log('Admin Notification:', event.message);
        // Hiển thị thông báo hoặc thực hiện các xử lý khác
    });