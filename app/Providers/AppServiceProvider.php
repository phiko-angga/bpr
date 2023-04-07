<?php

namespace App\Providers;

use App\Models\Pages;
use App\Models\Post;
use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
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
            $pages = Pages::all();
            view()->share('pages', $pages);
        });

        view()->composer('part.card_list_post', function ($view) {
            
            $post = new Post;
            $posts = $post->getAllByCategory(request()->path(),'pages');
            view()->share('posts', $posts);
        });

        view()->composer('layout._navbar', function ($view) {
            $menu = Menu::with('submenu')->where(['status' => 'public', 'is_active' => 1])->orderBy('order','asc')->get();
            view()->share('menus', $menu);
        });
    }
}
