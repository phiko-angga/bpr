<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Site;
use App\Models\Pages;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostPages;
use App\Models\HomeBanner;
use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Log;

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

        view()->composer('part.card_list_pages', function ($view) {
            $pages = Pages::where('is_top',1)->get();
            view()->share('pages', $pages);
        });

        view()->composer('part.card_list_post', function ($view) {
            
            $post = new Post;
            $posts = $post->getAllByPages(request()->path());
            $posts_publish = $posts->where('status','=','publish')->where('jenis_post','=','info');
            view()->share('posts', $posts_publish);
        });

        view()->composer('part.card_list_postcategory', function ($view) {
            
            $postcategory = new PostCategory;
            $postcategories = $postcategory->getAllByPages(request()->path());
            $publish = $postcategories->where('status','=','publish');
            view()->share('postcategories', $publish);
        });

        view()->composer('part.card_list_beritatop3', function ($view) {
            $posts_publish = Post::with('category')->where('status','=','publish')->where('jenis_post','=','post')->orderBy('date_publish','desc')->limit(3)->get();
            view()->share('posts', $posts_publish);
        });

        view()->composer('part.home_banner', function ($view) {
            $banner = HomeBanner::where('status','=','publish')->orderBy('order','asc')->get();
            view()->share('banner', $banner);
        });

        view()->composer('layout._navbar', function ($view) {
            $menu = Menu::with('submenu')->where(['status' => 'public', 'is_active' => 1])->orderBy('order','asc')->get();
            view()->share('menus', $menu);
        });

        view()->composer('layout._footer', function ($view) {
            $post = new Post;
            $tabungan = $post->getByCategory('tabungan',['limit' => 3]);
            $kredit = $post->getByCategory('kredit',['limit' => 3]);
            view()->share(['tabungan' => $tabungan, 'kredit' => $kredit]);
        });

        view()->composer('layout._template', function ($view) {
            $site = Site::first();
            $wa_phone = Config::where('name','wa_phone')->first();
            $wa_message = Config::where('name','wa_message')->first();
            view()->share(['site' => $site, 'wa_phone' => $wa_phone, 'wa_message' => $wa_message]);
        });

        Paginator::useBootstrap();
    }
}
