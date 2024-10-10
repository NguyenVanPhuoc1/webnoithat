// Lắng nghe sự kiện cuộn của trang
document.addEventListener('DOMContentLoaded', function() {
    var banner = document.querySelector('.wrap-header-menu .menu');
    banner.classList.remove('fixed');
    window.addEventListener('scroll', function() {
        var scrollPosition = window.scrollY || window.pageYOffset;
    
        if (scrollPosition > 100) { // Thêm lớp chỉ khi chưa thêm và vị trí scroll đủ điều kiện
            banner.classList.add('fixed');
        } else if (scrollPosition <= 100 ) { // Loại bỏ lớp khi scroll lên đầu trang
            banner.classList.remove('fixed');
        }
    });
});

// Chờ tài liệu HTML được tải xong
document.addEventListener("DOMContentLoaded", function () {
    // Lấy tiêu đề trang
    var pageTitle = document.title;
    // alert(pageTitle);
    // Kiểm tra xem tiêu đề có chứa từ khóa "tin tức" không
    if (pageTitle.includes("Tin Tức")) {
        // Nếu có, thêm/xóa lớp khỏi thẻ body
        document.body.classList.remove("body");
    }
}); 

const backToTopBtn = document.querySelector('.scrollToTop');
    window.addEventListener("scroll", () => {
        if (window.scrollY > 200) {
            backToTopBtn.classList.add("show");
        } else {
            backToTopBtn.classList.remove("show");
        }
    });

    backToTopBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
});


// chuyển tab
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-nav li');
    const tabContents = document.querySelectorAll('.tab-pane');
    // Kiểm tra xem có phần tử tabs hay không
    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                tab.classList.add('active');
                const tabId = tab.querySelector('a').getAttribute('href').substring(1);
                const tabContent = document.getElementById(tabId);
                tabContent.classList.add('active');
            });
        });

        // Set the initial active tab

        tabs[0].click();
    }
});

// Hàm để kiểm tra và khởi tạo menu
new Mmenu(document.querySelector("#menu"));
// const menu_tab = document.querySelector('#menu');
// khi mà tạo menu thì tự động tạo class mm-wrapper--position-left
var bodyElement = document.body;

if (window.innerWidth > 1000) {
    bodyElement.classList.remove("mm-wrapper--position-left");
}
// document.addEventListener("click", function (evnt) {
//     var anchor = evnt.target.closest('a[href="#/"]');
//     if (anchor) {
//         alert("Thank you for clicking, but that's a demo link.");
//         evnt.preventDefault();
//     }
// });


// HoldOn load trang
var options = {
    theme: "sk-folding-cube",
    backgroundColor: "#fff",
};

HoldOn.open(options);

// Sử dụng setTimeout để đóng HoldOn sau 2 giây (2000 mili giây)
setTimeout(function() {
    HoldOn.close();
}, 2000); // 2 giây

// Data animations mảng hiệu ứng
// create array animations
var data_animations = [
    'animate__fadeInDown', 'animate__backInUp', 'animate__rollIn', 'animate__backInRight', 'animate__zoomInUp', 'animate__backInLeft', 'animate__rotateInDownLeft', 'animate__backInDown', 'animate__zoomInDown', 'animate__fadeInUp', 'animate__zoomIn',
]; 

$(document).ready(function () {
    $('#carouselExampleControls').on('slide.bs.carousel', function (e) {
        var $e = $(e.relatedTarget);
        // Chọn ngẫu nhiên một animation từ danh sách
        var randomAnimation = data_animations[Math.floor(Math.random() * data_animations.length)];
        console.log(randomAnimation)
        // Xóa tất cả các lớp animations hiện tại
        $e.removeClass(data_animations.join(' '));
        
        // Thêm lớp animation mới
        $e.addClass(randomAnimation).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $e.removeClass(randomAnimation); // Sau khi hoàn thành animation, loại bỏ lớp
        });
    });
});

// Tìm kiếm
function performSearch(formId, inputId) {
    // Lấy giá trị từ input
    var searchKeyword = document.getElementById(inputId).value;

    // Nếu input không rỗng, submit form
    if (searchKeyword.trim() !== '') {
        document.getElementById(formId).submit();
    } else {
        // Nếu input rỗng, hiển thị thông báo lỗi
        document.getElementById('searchError1').textContent = 'Vui lòng nhập từ khóa tìm kiếm.';
        document.getElementById('searchError1').style.setProperty('display', 'block', 'important');
    }
}
