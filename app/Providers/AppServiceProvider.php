<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Contracts\Events\Dispatcher;
// use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot(Dispatcher $events)
    public function boot()
    {
        // $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
        //     $event->menu->add('MAIN NAVIGATIsON');
        //     $items = [
        //         [
        //             'text' => 'aaa',
        //             'url' => 'aa'
        //         ],
        //         [
        //             'text' => 'bbb',
        //             'url' => 'bb'
        //         ],
        //         [
        //             'text' => 'ccc',
        //             'url' => 'ccc'
        //         ]
        //     ];
        //     $event->menu->add(...$items);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
