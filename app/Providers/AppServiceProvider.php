<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    // временно отключим кэш
    public function boot(): void
    {
        if (config('app.is_installing')) {
            // Действия при установке приложения
        } else {
            // Код ниже выполняется если приложение уже установлено
            // и фраг IS_INSTALLING в .env поставлен false.
            Paginator::useBootstrapFive();

            // Проблема при установке проекта с нуля, ругается на кэш:
            // кэшируем топ-5 самых активных пользователей
            $topUsers = Cache::remember('topUsers', now()->addSeconds(10), function () {
                return User::withCount('ideas')
                    ->orderBy('ideas_count', 'DESC')
                    ->limit(5)->get();
            });

            // dd($topUsers);

            // поделимся полученным списком со всеми Blade шаблонами
            View::share('topUsers', $topUsers);
        }
    }




    // При установке пустой программы даже vendor не инсталируется при команде composer install
    // Пишет что табилца с кешем пустая, и дело дальше не идёт.
    //      public function boot(): void
    //     {

    //         //
    //         Paginator::useBootstrapFive();

    //         // app()->setLocale('ru');
    //         // App::setLocale('ru');

    //         // если система не видит Debugbar
    // //        if (env('APP_DEBUG') == true) {
    // //            \Debugbar::enable();
    // //        }

    //         // cache()->forget('topUsers');
    //         // Cache::forget('topUsers');

    //         // получим список 5-ти самых активных пользователей
    //         // $topUsers = User::withCount('ideas')
    //         //     ->orderBy('ideas_count', 'DESC')
    //         //     ->limit(5)->get();


    //         // Проблема при установке проекта с нуля, ругается на кэш:
    //         // кэшируем топ-5 самых активных пользователей
    //         $topUsers = Cache::remember('topUsers', now()->addSeconds(10), function () {
    //             return User::withCount('ideas')
    //                 ->orderBy('ideas_count', 'DESC')
    //                 ->limit(5)->get();

    //         });

    //         // dd($topUsers);

    //         // поделимся полученным списком со всеми Blade шаблонами
    //         View::share('topUsers', $topUsers);

    //     }


}
