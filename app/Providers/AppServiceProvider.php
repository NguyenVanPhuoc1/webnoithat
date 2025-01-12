<?php

namespace App\Providers;

use App\Services\NewsletterRepository;
use App\Services\SettingRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Services\FileStorageService;
use Illuminate\Support\ServiceProvider;
use App\Services\CategoryRepository;
use App\Services\ProductRepository;
use App\Services\PoliRepository;
use App\Services\NewsRepository;
use App\Services\UserRepository;
use Illuminate\Support\Facades\App;
use App\Models\Setting;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PolicyController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\PayOsService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        //binding class
        // Mỗi lần gọi, tạo ra một instance mới giúp đảm bảo rằng mỗi Repository được khởi tạo độc lập, tránh các xung đột khi Repository này xử lý trạng thái của Model khác.
        // Dễ bảo trì: Khi cần thay đổi hoặc mở rộng Repository, bạn có thể chỉnh sửa hoặc tạo mới các class con mà không ảnh hưởng đến các phần còn lại của ứng dụng.
        // Độc lập cho từng Model: Mỗi Model có thể có các yêu cầu và logic riêng biệt, nên khởi tạo mới mỗi lần gọi sẽ giúp cách ly các thao tác cụ thể của từng Model.
        $this->app->bind(ProductRepository::class, ProductRepository::class);
        $this->app->bind(CategoryRepository::class, CategoryRepository::class);
        // news
        $this->app->bind(NewsRepository::class, NewsRepository::class);
        //policy
        $this->app->bind(PoliRepository::class, PoliRepository::class);
        //user
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(new \App\Models\User);
        });
        $this->app->bind(FileStorageService::class);
        $this->app->bind(NewsletterRepository::class, NewsletterRepository::class);
        $this->app->bind(SettingRepository::class, SettingRepository::class);

        // $this->app->singleton(PayOsService::class, function ($app) {
        //     return new PayOsService(
        //         env('PAYOS_CLIENT_ID'),
        //         env('PAYOS_API_KEY'),
        //         env('PAYOS_CHECKSUM_KEY'),
        //     );
        // });
    }

    /**
     * Bootstrap any application services.
     * thực hiện các thiết lập cần thiết khi ứng dụng được khởi động
     */
    public function boot(): void
    {
        //fix database
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $languageCode = session()->get('locale') ? session()->get('locale') : 'vi';
             // Cập nhật ngôn ngữ cho ứng dụng
            App::setLocale($languageCode);
            $logo = Setting::getValue('logo'); // Lấy thông tin về logo từ cơ sở dữ liệu
            $favicon = Setting::getValue('favicon'); // Lấy thông tin về logo từ cơ sở dữ liệu
            $listNews = NewsController::getLoadedNews($languageCode);
            // dd($listNews);die();
            $listPoli = PolicyController::getLoadedPoli($languageCode);

            $cartList = Cart::content()->count();
            $view->with('logo', $logo)->with('favicon', $favicon)
            ->with('listNews',$listNews)->with('listPoli',$listPoli)
            ->with('cartCount', $cartList)->with('languageCode',$languageCode);
        });
    }
}
