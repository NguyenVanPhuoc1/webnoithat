<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\PurchaseProcess\CartController;
use App\Http\Controllers\PurchaseProcess\PaymentController;
use App\Http\Controllers\PurchaseProcess\VietQrPaymentController;
use App\Http\Controllers\PurchaseProcess\VnpayPaymentController;
use App\Http\Controllers\Setting\FaviconController;
use App\Http\Controllers\Setting\LogoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Auth\PasswordAuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\IntroductPageController;
use App\Http\Controllers\PolicyController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// set language cho frontend user
Route::middleware('change.language')->group(function () {
    Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change-language');

    //trang chủ 
    Route::get('/', [HomeController::class, 'viewHome'])->name('home');
    Route::get('/get-products/{categoryId}', [HomeController::class, 'getProductbyCate']);
    //page giới thiệu
    Route::get('gioi-thieu', [IntroductPageController::class, 'viewIntroducePage'])->name('gioithieu');

    // Route::get('/chi-tiet-san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');
    //trang sản phẩm
    Route::get('/san-pham', [HomeController::class, 'searchProduct'])->name('search');
    //trang chi tiết sản phẩm
    Route::get('/san-pham/{slug}', [ProductController::class, 'getDetailProductbySlug'])->name('product_detail');
    //trang tin tức
    Route::get('/tin-tuc', [NewsController::class, 'getAllNewsForUser'])->name('get_news');
    Route::get('/tin-tuc/{slug}', [NewsController::class, 'getDetailNews'])->name('news_detail');
    //trang chính sách
    Route::get('/chinh-sach', [PolicyController::class, 'getAllPolicyForUser'])->name('get_policy');
    Route::get('/chinh-sach/{slug}', [PolicyController::class, 'getDetailPolicy'])->name('policy_detail');
    //trang liên hệ
    Route::get('/lien-he', [IntroductPageController::class, 'viewContact']);
    Route::post('/lien-he', [NewsletterController::class, 'addCustomer'])->name('regis-customer');

    Route::middleware(['auth','auth.access'])->group(function () {
        
        // page giỏ hàng
        Route::get('/gio-hang', [CartController::class, 'viewCart'])->name('cart.index');
        Route::get('/gio-hang/add', [CartController::class, 'addCart'])->name('cart.add');
        Route::delete('/gio-hang/delete/{rowId}', [CartController::class, 'deleteCart'])->name('cart.delete');
        Route::patch('/gio-hang/update/{rowId}', [CartController::class, 'updateCart'])->name('cart.update');   
        //page thanh toán 
        Route::post('/vnpay-payment', [PaymentController::class, 'payment'])->name('vnpay.payment');
        //vnpay return result
        Route::get('/vnpay-return', [PaymentController::class, 'handleVnpayResult'])->name('vnpay.return');
        // Route::get('/vnpay-return', [VnpayPaymentController::class, 'handleVnpayReturn'])->name('vnpay.return');
        //thanh toán vietqr
        Route::get('/generate-qr', [VietQrPaymentController::class, 'generateQRCode']);
        // Route::post('/create-payment-link', [VietQrPaymentController::class, 'createPaymentLink']);
        Route::prefix('/order')->group(function () {
            Route::get('/success', [VietQrPaymentController::class, 'viewPageSuccessPayment'])->name('success.payment');
            Route::get('/cancle', [VietQrPaymentController::class, 'viewPageCanclePayment'])->name('cancle.payment');
        });

        Route::prefix('/payment')->group(function () { 
            Route::post('/payos', [VietQrPaymentController::class, 'handlePayOSWebhook']);
        });

    });
});

Route::middleware('guest')->group(function () {

    Route::get('register', [CustomAuthController::class, 'createRegister'])
        ->name('register');

    Route::post('register', [CustomAuthController::class, 'register'])
    ->name('users.register');;

    Route::get('login', [CustomAuthController::class, 'createLogin'])
        ->name('login');

    Route::post('login', [CustomAuthController::class, 'login'])
    ->name('login.custom');
    //login with google
    Route::get('/login/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('login.google');

    Route::get('forgot-password', [PasswordAuthController::class, 'viewForgetPassword'])
    ->name('password.request');

    Route::post('forgot-password', [PasswordAuthController::class, 'sendMailResetPassword'])
        ->name('password.email');

    Route::get('reset-password/{token}', [PasswordAuthController::class, 'viewResetPassword'])
        ->name('password.reset');

    Route::post('reset-password', [PasswordAuthController::class, 'resetPassword'])
        ->name('password.store');
});

Route::get('/login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::middleware(['auth','auth.access'])->group(function () {
    // Admin trang chủ
    Route::get('/admin/trang-chu', [DashboardController::class, 'viewChart'])->name('admin.dashboard');

    //Admin quản lí danh mục
    Route::get('/admin/quanlidanhmuc',[CategoryController::class, 'viewAdminDanhmuc'] )->name('category_admin');
    Route::get('/admin/quanlidanhmuc/add-cate',[CategoryController::class, 'viewPageaddCate'] )->name('view_add_cate');
    Route::post('/admin/quanlidanhmuc/add-cate', [CategoryController::class, 'addCate'])->name('add-cate');
    Route::get('/admin/quanlidanhmuc/update/{id}',[CategoryController::class, 'viewPageupdateCate'] )->name('view_update_cate');
    Route::patch('/admin/quanlidanhmuc/update/{id}', [CategoryController::class, 'updateCate'])-> name('admin-updateCate');
    Route::delete('/admin/quanlidanhmuc/delete', [CategoryController::class, 'deleteCateSelectedIds'])->name('deleteCate');//xóa theo checkbox
    Route::get('/admin/quanlidanhmuc/delete/{id}', [CategoryController::class, 'deleteCateId'])->name('deleteCatebyId');//xóa khi có id
    Route::post('/admin/quanlidanhmuc/update-noibat/{id}', [CategoryController::class, 'checkNoiBat']);

    //Admin quản lí tin tức
    Route::get('/admin/quanlibaiviet/tintuc',[NewsController::class, 'viewAdminTintuc'] )->name('news_admin');
    Route::get('/admin/quanlibaiviet/add-tintuc',[NewsController::class, 'viewPageaddNews'] )->name('view_add_news');
    Route::post('/admin/quanlibaiviet/tintuc/add-tintuc', [NewsController::class, 'addNews'])->name('add-news');
    Route::get('/admin/quanlibaiviet/tintuc/update/{id}',[NewsController::class, 'viewPageupdateNews'] )->name('view_update_news');
    Route::patch('/admin/quanlibaiviet/tintuc/update/{id}', [NewsController::class, 'updateNews'])-> name('admin-updateNews');
    Route::delete('/admin/quanlibaiviet/tintuc/delete', [NewsController::class, 'deleteNewsSelectedIds'])->name('deleteNews');//xóa theo checkbox
    Route::get('/admin/quanlibaiviet/tintuc/delete/{id}', [NewsController::class, 'deleteNewsId'])->name('deleteNewsbyId');//xóa khi có id
    Route::post('/admin/quanlibaiviet/tintuc/update-noibat/{id}', [NewsController::class, 'checkNoiBat']);

    //Admin quản lí chính sách
    Route::get('/admin/quanlibaiviet/chinhsach',[PolicyController::class, 'viewAdminChinhSach'] )->name('poli_admin');
    Route::get('/admin/quanlibaiviet/add-chinhsach',[PolicyController::class, 'viewPageaddPolicy'] )->name('view_add_poli');
    Route::post('/admin/quanlibaiviet/chinhsach/add-chinhsach', [PolicyController::class, 'addPolicy'])->name('add-poli');
    Route::get('/admin/quanlibaiviet/chinhsach/update/{id}',[PolicyController::class, 'viewPageupdatePolicy'] )->name('view_update_poli');
    Route::patch('/admin/quanlibaiviet/chinhsach/update/{id}', [PolicyController::class, 'updatePolicy'])-> name('admin-updatePoli');
    Route::delete('/admin/quanlibaiviet/chinhsach/delete', [PolicyController::class, 'deletePoliSelectedIds'])->name('deletePolicys');//xóa theo checkbox
    Route::get('/admin/quanlibaiviet/chinhsach/delete/{id}', [PolicyController::class, 'deletePoliId'])->name('deletePolibyId');//xóa khi có id
    Route::post('/admin/quanlibaiviet/chinhsach/update-noibat/{id}', [PolicyController::class, 'checkNoiBat']);

    //Admin quản lí sản phẩm
    Route::get('/admin/quanlisanpham',[ProductController::class, 'viewAdminProduct'] )->name('product_admin');
    Route::get('/admin/quanlisanpham/add-sanpham',[ProductController::class, 'viewPageaddProduct'] )->name('view_add_product');
    Route::post('/admin/quanlisanpham/sanpham/add-sanpham',[ProductController::class, 'addProduct'] )->name('add-product');
    Route::get('/admin/quanlisanpham/update/{id}',[ProductController::class, 'viewPageupdateProduct'] )->name('view_update_product');
    Route::patch('/admin/quanlisanpham/update/{id}', [ProductController::class, 'updateProduct'])-> name('admin-updateProduct');
    Route::post('/remove-file', [ProductController::class, 'deleteFileImage']);
    Route::delete('/admin/quanlisanpham/delete', [ProductController::class, 'deleteProductSelectedIds'])->name('deleteProduct');//xóa theo checkbox
    Route::get('/admin/quanlisanpham/delete/{id}', [ProductController::class, 'deleteProductId'])->name('deleteProductbyId');//xóa khi có id
    Route::post('/admin/quanlisanpham/update-noibat/{id}', [ProductController::class, 'checkNoiBat']);

    //Admin quản lí nhận tin
    Route::get('/admin/quanlinhantin',[NewsletterController::class, 'viewAdminNhanTin'] )->name('newsletter_admin');
    Route::delete('/admin/quanlinhantin/delete',[NewsletterController::class, 'deleteNewsletterSelectedIds'] )->name('deleteNewsletter');
    Route::get('/admin/quanlinhantin/delete/{id}',[NewsletterController::class, 'deleteNewsletterId'] )->name('deleteNewsletterbyId');
    Route::post('/admin/quanlinhantin/sendmail',[NewsletterController::class, 'sendMailCustomer'] )->name('sendmailCus');

    //Admin quản lí favicon
    Route::get('admin/favicon', [FaviconController::class, 'viewPageFavicon'])->name('favicon_admin');
    Route::post('admin/update-favicon', [FaviconController::class, 'updateFavicon'])->name('update_favicon');

    //Admin quản lí logo
    Route::get('admin/logo', [LogoController::class, 'viewPageLogo'])->name('logo_admin');
    Route::post('admin/update-logo', [LogoController::class, 'updateLogo'])->name('update_logo');

    //Admin quản lí người dùng
    Route::get('admin/quanliuser', [UserController::class, 'viewPageUser'])->name('user_admin');


    Route::get('logout', [CustomAuthController::class, 'logout'])
        ->name('signout');
});
