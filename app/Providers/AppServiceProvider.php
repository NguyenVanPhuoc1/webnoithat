<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\News;
use App\Models\Policy;
use Illuminate\Support\Facades\View;
use App\Models\Logo; //model cho logo là Logo
use App\Models\Favicon; //model cho logo là Logo
use App\Models\Customers;

use Gloudemans\Shoppingcart\Facades\Cart ;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        //fix database
        Schema::defaultStringLength(191);

        // 
        $news = News::orderBy('created_at', 'desc')
        ->where('noi_bat', true) 
        ->take(5) 
        ->get();
        $policy = Policy::orderBy('created_at', 'desc')
        ->where('noi_bat', true) 
        ->take(5) 
        ->get();

        $viewData = [
            'listNews' => $news,
            'listPoli' => $policy,
            'totalCus' => Customers::count(),
        ];
        view()->share($viewData);


        View::composer('*', function ($view) {
            $logo = Logo::first(); // Lấy thông tin về logo từ cơ sở dữ liệu
            $favicon = Favicon::first(); // Lấy thông tin về logo từ cơ sở dữ liệu
            $cartList = Cart::content()->count();
            $view->with('logo', $logo)->with('favicon', $favicon)->with('cartCount', $cartList);
        });
    }
}
