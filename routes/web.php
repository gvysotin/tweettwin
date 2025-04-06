<?php

use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\UserController;
use App\Models\Idea;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Route;




Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');




Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/', function() {
//     return env('APP_NAME', 'Laravel');

// })->name('dashboard');



Route::get('/lang/{lang}', function($lang) {

    // dd($lang);

    app()->setLocale($lang);

    session()->put('locale', $lang);

    // dd(app()->getLocale());

    return redirect()->route('dashboard');

})->name('setlang');





//Route::post('/idea', [IdeaController::class,'store'])->name('idea.create');

// Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {

//  Route::get('/{idea}', [IdeaController::class, 'show'])->name('show')->withoutMiddleware('auth');

// Route::group(['middleware' => ['auth']], function () {

// Route::post('', [IdeaController::class, 'store'])->name('store')->withoutMiddleware('auth');

// Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');

// Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');

// Route::delete('/{id}', [IdeaController::class, 'destroy'])->name('destroy');

//         Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');

//     });

// });

Route::resource('ideas', IdeaController::class)->except(['index','create'])->middleware('auth');

Route::resource('ideas', IdeaController::class)->only(['show']);

// ideas/{idea}/comments/{comment}, т.е. ideas. = ideas/{idea}
Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');


Route::resource('users', UserController::class)->only(['show']);
Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware('auth');


Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/profile2/{user}', [UserController::class, 'profile2'])->middleware('auth')->name('profile2');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');

// Подборка (на кого подписан пользователь)
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

// Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'admin']);

Route::middleware(['auth', 'can:admin'])->prefix('/admin')->as('admin.')->group(function(){
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Route::get('/users', [AdminUserController::class, 'index'])->name('users');

    Route::resource('users', AdminUserController::class)->only(['index']);
    Route::resource('ideas', AdminIdeaController::class)->only(['index']);
    Route::resource('comments', AdminCommentController::class)->only('index', 'destroy');
    // Route::resource('comments', AdminUserController::class)->only(['index']);

});



// Измерение скорости вычислений
Route::get('/feed2', function() {

    $aaa2 = '';

    $aaa = Benchmark::measure(function () use (&$aaa2) {
        $aaa2 = Idea::all();

    }) ;

    echo $aaa . "<br><br>" . $aaa2;

});


// Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'can:admin']);



// Route::get('/feed', [FeedController::class, 'show_feed'])->middleware('auth')->name('feed');


// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


//
//
//

//Route::get('/', function () {
//    return view('welcome');
//});


require __DIR__.'/auth.php'; // Фишка Laravel 11, в предыдущем Laravel было по другому.
