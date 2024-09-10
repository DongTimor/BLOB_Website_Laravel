<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Models\FollowModel;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (auth()->user()) {
        return redirect(route('reset'));
    }
    return view('welcome');
});
//------------------------------------------------------------ CONTENT ---------------------------------------------------------------//

//get content data
Route::get('/content', [ContentController::class, 'index'])->name('content.index');
//Search
Route::get('/search', [ContentController::class, 'search'])->name('content.search');

//Like content
// Route::put('/content/{content}/like',[ContentController::class,'like'])->name('content.like');

//------------------------------------------------------------ REGISTER ---------------------------------------------------------------//
Route::get('/register', [AuthController::class, 'register'])->name('register');
//Store register data
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
//------------------------------------------------------------ AUTHENTICATION ---------------------------------------------------------------//
Route::get('/login', [AuthController::class, 'login'])->name('login');
//Store login data
Route::post('/login', [AuthController::class, 'authentication'])->name('authentication');
//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//------------------------------------------------------------ INTERACTION ---------------------------------------------------------------//
Route::group(['prefix' => 'content/', 'as' => 'content.'], function () {
    Route::group(["middleware" => "auth"], function () {
        //Store content
        Route::put('', [ContentController::class, 'store'])->name('store');
        //Edit
        Route::get('{item}/edit', [ContentController::class, 'edit'])->name('edit');
        //Update
        Route::put('{item}', [ContentController::class, 'update'])->name('update');
        //Delete
        Route::delete('{item}', [ContentController::class, "delete"])->name('delete');
    });

    //Show
    Route::get('{item}', [ContentController::class, 'show'])->name('show');
});

//------------------------------------------------------------ COMMENT ---------------------------------------------------------------//
Route::post('/content/{item}/comment', [CommentController::class, 'store'])->name('comment.store')->middleware("auth");


Route::get('/clear-session-and-redirect', function () {
    session()->forget('currentPage');
    return redirect('/content');
})->name("reset");

Route::resource('user', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::get("/profile", [UserController::class, "profile"])->name('profile')->middleware('auth');

Route::post("/user/{user}/follow", [FollowController::class, "follow"])->name("follow")->middleware("auth");

Route::post("/user/{user}/unfollow", [FollowController::class, "unfollow"])->name("unfollow")->middleware("auth");

Route::put("/content/{content}/like", [LikeController::class, "like"])->name("like")->middleware("auth");

Route::put("/content/{content}/unlike", [LikeController::class, "unlike"])->name("unlike")->middleware("auth");
