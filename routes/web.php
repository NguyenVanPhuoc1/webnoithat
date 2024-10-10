<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\FaviconController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\IntroductPageController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;

//Login Admin
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PasswordResetController;

Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function ()  {
  // Các route của bạn ở đây
  Route::get('/sign-up', [CustomAuthController::class, 'signUp'])->name('sign-up');
  Route::post('/sign-up', [CustomAuthController::class, 'register'])->name('users.register');
  Route::get('/login', [CustomAuthController::class, 'Login'])->name('login');
  Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
  Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
  Route::get('/login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
  Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
  
  //Home
  Route::get('/', [HomeController::class, 'viewHome'])->name('index');
  Route::get('/ket-qua-tim-kiem-san-pham', [HomeController::class, 'searchProduct'])->name('search');
  Route::get('/get-products/{categoryId}', [HomeController::class, 'getProductbyCate']);
  
  // danh sách sản phẩm & chi tiết sản phẩm
  Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
  Route::get('/chi-tiet-san-pham/{id}', [ProductController::class, 'show'])->name('products.show');
  // Route::post('/product/{productId}/comments', [CommentController::class, 'store'])->name('product.comments.store');

  //Page Tin Tức
  Route::get('/tin-tuc', [NewsController::class, 'viewTinTuc']);
  Route::get('/tin-tuc/tin-tuc-{id}', [NewsController::class, 'viewDetailNews'])->name('news_detail');

  //Chính sách
Route::get('/chinh-sach', [PolicyController::class, 'viewChinhSach']);
Route::get('/chinh-sach/chinh-sach-{id}', [PolicyController::class, 'viewDetailPolicy'])->name('policy_detail');

//page giới thiệu
Route::get('/gioi-thieu', [IntroductPageController::class, 'viewIntroducePage']);


// Page trang chủ
Route::post('/', [SendMailController::class, 'AddCustomer'])->name('add-customer');

// page lien he
Route::get('/lien-he', [IntroductPageController::class, 'viewContact']);
Route::post('/lien-he', [SendMailController::class, 'AddCustomer'])->name('regis-customer');



});


Route::middleware(['auth','admin.access'])->group(function () {
    // Các route của trang admin
    Route::get('/admin', [CustomAuthController::class, 'Dashboard'])->name('admin');
    // ...trang chủ
    Route::get('/admin/trang-chu', [ChartController::class, 'viewChart']);
      // them, xóa sửa sản phẩm
    Route::resource('admin/quanlisanpham', ProductController::class);
    Route::get('admin/quanlisanpham', [ProductController::class, 'indexAdmin'])->name('productsAdmin.show');
    Route::get('/admin/quanlisanpham/san-pham-{id}/update-noibat', [ProductController::class, 'checkNoiBat'])->name('checkNoiBat');//check box nổi bật
    Route::post('/admin/quanlisanpham/create', [ProductController::class, 'addProduct'])->name('add-product');
    Route::get('/admin/quanlisanpham/{id}', [ProductController::class, 'show'])->name('admin_view_product');
    Route::post('/admin/quanlisanpham', [ProductController::class, 'store'])-> name('updateProducts');
    Route::get('/admin/quanlisanpham/sanpham/delete', [ProductController::class, 'deleteProducts'])->name('deleteProducts');//xóa theo checkbox
    Route::get('/admin/quanlisanpham/delete/{id}', [ProductController::class, 'destroy'])->name('deleteProductbyId');
    // quản lí logo
    Route::get('admin/logo', [LogoController::class, 'index']);
    Route::post('admin/update-logo', [LogoController::class, 'updateLogo']);
    // quan li favicon
    Route::get('admin/favicon', [FaviconController::class, 'index']);
    Route::post('admin/update-favicon', [FaviconController::class, 'updateFavicon']);
  
    //Admin quản lí tin tức
    Route::get('/admin/quanlibaiviet/tintuc',[NewsController::class, 'viewAdminTinTuc'] )->name('news_search');
    Route::get('/admin/quanlibaiviet/add-tintuc',[NewsController::class, 'viewPageaddNews'] )->name('view_add_news');
    Route::post('/admin/quanlibaiviet/tintuc/add-tintuc', [NewsController::class, 'AddNews'])->name('add-news');
    Route::get('/admin/quanlibaiviet/tintuc/tin-tuc-{id}',[NewsController::class, 'viewDetailNews'] )->name('admin_view_news');
    Route::post('/admin/quanlibaiviet/tintuc', [NewsController::class, 'updateNews'])-> name('admin-updateNews');
    Route::get('/admin/quanlibaiviet/tintuc/delete', [NewsController::class, 'deleteNews'])->name('deleteNews');//xóa theo checkbox
    Route::get('/admin/quanlibaiviet/tintuc/delete/{id}', [NewsController::class, 'deleteNewsbyId'])->name('deleteNewsbyId');//xóa khi có id
    Route::get('/admin/quanlibaiviet/tintuc/tin-tuc-{id}/update-noibat', [NewsController::class, 'checkNoiBat'])->name('checkNoiBat');//xóa khi có id

    //page quan lí nhận tin admin
    Route::get('/admin/quanlinhantin', [SendMailController::class, 'viewPageQliNhanTin']);
    Route::get('/admin/quanlibaiviet/customer/delete', [SendMailController::class, 'totalCustomer'])->name('delete_send_Customer');
    Route::get('/admin/quanlinhantin/customer/delete/{id}', [SendMailController::class, 'deleteCustomerbyId'])->name('deleteCusbyId');

    //Admin quản lí chính sách
    Route::get('/admin/quanlibaiviet/chinhsach',[PolicyController::class, 'viewAdminChinhSach'] )->name('poli_search');
    Route::get('/admin/quanlibaiviet/add-chinhsach',[PolicyController::class, 'viewPageaddPoli'] )->name('view_add_policys');
    Route::post('/admin/quanlibaiviet/chinhsach/add-chinhsach', [PolicyController::class, 'AddPolicys'])->name('add-policy');
    Route::get('/admin/quanlibaiviet/chinhsach/chinh-sach-{id}',[PolicyController::class, 'viewDetailPolicy'] )->name('admin_view_poli');
    Route::post('/admin/quanlibaiviet/chinhsach', [PolicyController::class, 'updatePolicys'])-> name('admin-updatePolicys');
    Route::get('/admin/quanlibaiviet/chinhsach/delete', [PolicyController::class, 'deletePolicys'])->name('deletePolicys');//xóa theo checkbox
    Route::get('/admin/quanlibaiviet/chinhsach/delete/{id}', [PolicyController::class, 'deletePolicybyId'])->name('deletePolibyId');//xóa khi có id
    Route::get('/admin/quanlibaiviet/chinhsach/chinh-sach-{id}/update-noibat', [PolicyController::class, 'checkNoiBat'])->name('checkNoiBat');//xóa khi có id

    // change password - chiến
    Route::get('/admin/changepassword', [CustomAuthController::class, 'viewChangePassword']);
    Route::post('/admin/changepassword', [CustomAuthController::class, 'changePassword'])->name('change.password.post');

    // Admin danh muc
    Route::get('/admin/quanlidanhmuc', [CategoryController::class, 'viewCategory']);
    Route::get('/admin/quanlidanhmuc/add-cate',[CategoryController::class, 'viewPageaddCate'] )->name('view_add_cate');
    Route::post('/admin/quanlidanhmuc/add-cate', [CategoryController::class, 'AddCate'])->name('add-cate');
    Route::get('/admin/quanlidanhmuc/danh-muc-{id}',[CategoryController::class, 'viewDetailCate'] )->name('admin_view_cate');
    Route::post('/admin/quanlidanhmuc', [CategoryController::class, 'updateCate'])-> name('admin-updateCate');
    Route::get('/admin/quanlidanhmuc/delete', [CategoryController::class, 'deleteCate'])->name('deleteCate');//xóa theo checkbox
    Route::get('/admin/quanlidanhmuc/delete/{id}', [CategoryController::class, 'deleteCatebyId'])->name('deleteCatebyId');//xóa khi có id
    Route::get('/admin/quanlidanhmuc/danh-muc-{id}/update-noibat', [CategoryController::class, 'checkNoiBat'])->name('checkNoiBat');//xóa khi có id

    // page giỏ hàng
    Route::get('/gio-hang', [CartController::class, 'viewCart'])->name('cart.index');
    Route::get('/gio-hang/add', [CartController::class, 'addCart'])->name('cart.add');
    Route::delete('/gio-hang/delete/{rowId}', [CartController::class, 'deleteCart'])->name('cart.delete');
    Route::patch('/gio-hang/update/{rowId}', [CartController::class, 'updateCart'])->name('cart.update');

    // thanh toan vnpay
    Route::post('/vnpay-payment', [PaymentController::class, 'payment'])->name('vnpay.payment');
    Route::get('/vnpay-return', [PaymentController::class, 'handleVnpayReturn'])->name('vnpay.return');

    // hóa đơn
    Route::get('/hoa-don', [OrderController::class, 'viewOrder'])->name('order.index');
    Route::get('/tim-kiem-hoa-don', [OrderController::class, 'searchOrder'])->name('order.search');
    // Chi tiết hóa đơn
    Route::get('/chi-tiet-hoa-don/{id}', [OrderController::class, 'viewOrderItem'])->name('orderItem.index');
    Route::get('/download-pdf/{id}', [InvoiceController::class, 'download'])->name('download.pdf');
});

Route::get('/password-reset', [PasswordResetController::class, 'showEmailForm'])->name('password.reset');
Route::post('/password-reset', [PasswordResetController::class, 'sendOtp']);
Route::get('/password-reset/otp', [PasswordResetController::class, 'showOtpForm']);
Route::post('/password-reset/otp', [PasswordResetController::class, 'verifyOtp']);
Route::get('/password-reset/change', [PasswordResetController::class, 'showChangePasswordForm']);
Route::post('/password-reset/change', [PasswordResetController::class, 'changePassword']);






